<?php

namespace App\Http\Controllers;

use App\Book;
use DateTime;
use App\BorrowInformation;
use App\BorrowRecord;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BorrowBookController extends Controller
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
            $user = (new User())->getUserByUsername($request->input('user_name'));

            if (is_null($user)) {
                return response()->json([
                    'message' => 'Invalid User name!'
                ], 422);
            }

            $borrowCard = $user->getActiveBorrowCard();

            if (is_null($borrowCard)) {
                return response()->json([
                    'message' => 'The account not have valid borrow card!'
                ], 422);
            }

            $book = (new Book())->getBookByTitleAndNumber($request->input('book_title'), $request->input('book_number'));

            if (is_null($book)) {
                return response()->json([
                    'message' => 'No book match with title and book number!'
                ], 422);
            }

            $bookCopyIds = $book->getAttribute('copies')->pluck('id');

            $borrowRecord = (new BorrowRecord())->getRegisteredBorrowRecord($user->getAttribute('id'), $bookCopyIds);

            if (is_null($borrowRecord)) {
                return response()->json([
                    'message' => 'No record match!'
                ], 422);
            }

            $statusBefore = $borrowRecord->getAttribute('bookCopy')->getAttribute('integrity_status');

            return response()->json([
                'borrowRecord' => $borrowRecord->toArray(),
                'book' => $borrowRecord->getAttribute('bookCopy')->getAttribute('book'),
                'copyNumber' => $borrowRecord->getAttribute('bookCopy')
                    ->getAttribute('copy_number'),
                'statusBefore' => $statusBefore,
                'borrowCardNumber' => $borrowCard->getAttribute('card_number')
            ]);
        }

        return view('pages.borrow');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $borrowRecord = (new BorrowRecord())->getBorrowRecordByID($request->input('borrow_record_id'));
        $borrowInformation = $borrowRecord->getAttribute('borrowInformation');
        $currentDate = new DateTime();
        $expiredDate = (new DateTime())->modify('+14 day');

        if (is_null($borrowInformation)) {
            $newBorrowInformation = new BorrowInformation();
            $newBorrowInformation->updateNewBorrowInformation(
                $borrowRecord->getAttribute('id'),
                $borrowRecord->getAttribute('user')->getActiveBorrowCard()->getAttribute('id'),
                $request->input('status_before'),
                $currentDate,
                $expiredDate,
                $request->input('borrow_fee'),
                $request->input('pre_paid')
            );
        } else {
            $borrowInformation->updateNewBorrowInformation(
                $borrowRecord->getAttribute('id'),
                $borrowRecord->getAttribute('user')->getActiveBorrowCard()->getAttribute('id'),
                $request->input('status_before'),
                $currentDate,
                $expiredDate,
                $request->input('borrow_fee'),
                $request->input('pre_paid')
            );
        }

        $borrowRecord->updateBorrowRecordStatus('lent');

        $borrowRecord->getAttribute('bookCopy')->updateBookCopyStatus('lent', $request->input('status_before'));

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
