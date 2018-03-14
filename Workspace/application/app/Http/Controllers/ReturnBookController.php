<?php

namespace App\Http\Controllers;

use App\Book;
use App\BorrowRecord;
use App\User;
use App\BookCopy;
use App\BorrowCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReturnBookController extends Controller
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
        if ($request->ajax()) {
            $userName = $request->input('user_name');
            $borrowCardNumber = $request->input('card_number');
            $copyNumber = $request->input('copy_number');
            $user = null;
            $bookCopy = null;
            $borrowRecord = null;

            if (!is_null($userName) && !empty($userName)) {
                $user = (new User())->getUserByUserName($userName);
                if (!is_null($user) && !is_null($borrowCardNumber) && !empty($borrowCardNumber)) {
                    $userCard = $user->getBorrowCardNumber();
                    if (is_null($userCard) || $userCard != $borrowCardNumber) {
                        return response()->json([
                            'message' => 'Invalid User name/Borrow card number!'
                        ], 422);
                    }
                }
            } else {
                if (!is_null($borrowCardNumber) && !empty($borrowCardNumber)) {
                    $borrowCard = (new BorrowCard())->getBorrowCardByCardNumber($borrowCardNumber);
                    if (!is_null($borrowCard)) {
                        $user = $borrowCard->getAttribute('user');
                    }
                }
            }

            if (is_null($user)) {
                return response()->json([
                    'message' => 'Invalid User name!'
                ], 422);
            }

            if (!is_null($copyNumber) && !empty($copyNumber)) {
                $bookIds = (new Book())->where('title', 'like', '%'.$request->input('book_title').'%')
                    ->where('book_number', 'like', '%'.$request->input('book_number').'%')->pluck('id');
                $bookCopy = (new BookCopy())->where('copy_number', $copyNumber)
                    ->whereIn('book_id', $bookIds)->first();

                if (is_null($bookCopy)) {
                    return response()->json([
                        'message' => 'Invalid Book title/Book number/Copy number!'
                    ], 422);
                }

                $borrowRecord = (new BorrowRecord())
                    ->where('status', 'lent')
                    ->where('user_id', $user->getAttribute('id'))
                    ->where('book_copy_id', $bookCopy->getAttribute('id'))->first();
            } else {
                $book = (new Book())->where('title', 'like', '%'.$request->input('book_title').'%')
                    ->where('book_number', 'like', '%'.$request->input('book_number').'%')->first();

                if (is_null($book)) {
                    return response()->json([
                        'message' => 'Invalid Book title/Book number!'
                    ], 422);
                }

                $bookCopyIds = $book->getAttribute('copies')->pluck('id');
                $borrowRecord = (new BorrowRecord())
                    ->where('status', 'lent')
                    ->where('user_id', $user->getAttribute('id'))
                    ->whereIn('book_copy_id', $bookCopyIds)->first();
            }

            if (is_null($borrowRecord)) {
                return response()->json([
                    'message' => 'No record match!'
                ], 422);
            }

            return response()->json([
                'userName' => $user->getAttribute('name'),
                'cardNumber' => $borrowRecord->getAttribute('borrowInformation')
                    ->getAttribute('borrowCard')->getAttribute('card_number'),
                'bookTitle' => $borrowRecord->getAttribute('bookCopy')
                                    ->getAttribute('book')->getAttribute('title'),
                'bookNumber' => $borrowRecord->getAttribute('bookCopy')
                    ->getAttribute('book')->getAttribute('book_number'),
                'copyNumber' => $borrowRecord->getAttribute('bookCopy')
                    ->getAttribute('copy_number'),
                'borrowRecordInfo' =>$borrowRecord->getAttribute('borrowInformation')
                                        ->toArray()
            ]);
        }

        return view('pages.return');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $borrowRecord = (new BorrowRecord())->find($request->input('borrow_record_id'));
        $borrowInformation = $borrowRecord->getAttribute('borrowInformation');

        $borrowInformation->update([
            'status_after' => $request->input('status_after'),
            'compensation_fee' => $request->input('compensation_fee'),
            'total_paid' => $request->input('total_paid')
        ]);


        $borrowRecord->updateBorrowRecordStatus('returned');

        $borrowRecord->getAttribute('bookCopy')->updateBookCopyStatus('available', $request->input('status_after'));

        Session::flash('success', 'Lent book successfully!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
