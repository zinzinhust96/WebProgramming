<?php

namespace App\Http\Controllers;

use App\Book;
use App\BorrowRecord;
use App\User;
use App\BorrowCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BookBorrowRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $books = Book::orderBy('title')->paginate(15);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('book-borrow-registration._book_index')->with([
                    'books' => $books
                ])->render()
            ]);
        }

        return view('book-borrow-registration.create')->with([
            'books' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = (new User())->find(Auth::user()->id);
        $validator = Validator::make($request->all(), [
            'borrow-card' => 'required',
            'password-confirmation' => 'required'
        ]);

        if (!Hash::check($request->input('password-confirmation'), $user->getAttribute('password')))
        {
            $validator->errors()->add('password', 'The password confirmation not match!');
        }

        $borrowCard = (new BorrowCard())->getBorrowCardByCardNumber($request->input('borrow-card'));
        if (is_null($borrowCard)){
            $validator->errors()->add('borrow-card', 'The borrow card number is not valid!');
        }else {
            if(!$borrowCard->validateBorrowCard($user->getAttribute('id'))) {
                $validator->errors()->add('borrow-card', 'This borrow card is not belong to you!');
            }
            if(!$borrowCard->checkExpirationDate()) {
                $validator->errors()->add('borrow-card', 'Your borrow card is expired!');
            }
            if(!$borrowCard->isActivated()) {
                $validator->errors()->add('borrow-card', 'Your borrow card is not activated!');
            }
        }

        if ($user->hasOverDueBorrow()) {
            $validator->errors()->add('user', 'You have some over due lent books!');
        }

        $bookIDs = json_decode($request->input('book-ids'));

        $numberOfUserBorrowedCopies = $user->getNumberOfBorrowedCopies();
        if ($numberOfUserBorrowedCopies + count($bookIDs) > 5) {
            $validator->errors()->add('borrow-copies', 'Borrow exceed maximum number of copies allowed');
        }

        $bookObject = new Book();

        DB::beginTransaction();

        foreach ($bookIDs as $bookID) {
            $book = $bookObject->find($bookID);
            if (is_null($book)) {
                $validator->errors()->add('book-ids', 'The book id '.$bookID.' not found!');
                DB::rollback();
                break;
            }

            $bookCopy = $book->getAnAvailableCopy();
            if (is_null($bookCopy)) {
                $validator->errors()->add('book-ids', 'The book id '.$bookID.' not have any available copy!');
                DB::rollback();
                break;
            }
            
            $bookCopy->updateBookCopyStatus('borrowed');

            $borrowRecord = new BorrowRecord();
            $borrowRecord->createNewBorrowRecord(
                $bookCopy->getAttribute('id'),
                $user->getAttribute('id')
            );
        }

        if ($validator->errors()->count()) {
            return redirect()->back()->with('errors', $validator->errors());
        }

        DB::commit();

        return redirect()->route('book.borrow.register.create')->with('success', "Register successfully!");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}