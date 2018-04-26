<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\BorrowCard;

class BorrowCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = (new BorrowCard())->all();
        return view('borrow-card.index', ['cards' => $cards]);
    }

    public function search(Request $request) {
        $searchTerm = $request->input('searchTerm');
        $cards = (new BorrowCard())->where('card_number', $searchTerm)->get();
        return view('borrow-card.index', ['cards' => $cards]);
    }

    public function deactivate($id) {
        $borrowCard = (new BorrowCard())->where('id', $id)->first();
        $borrowCard->is_activated = 0;
        $borrowCard->save();
        Session::flash('success', 'The borrow card number ' . $borrowCard->card_number . ' was successfully deactivated!');
        return redirect('borrow-card');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $borrowCard = (new BorrowCard())->where('id', $id)->first();
        if (is_null($borrowCard)) {
            return redirect()->back();
        }
        return view('borrow-card.show', ['card' => $borrowCard]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $borrowCard = (new BorrowCard())->where('id', $id)->first();
        $borrowCard->expired_date = $request->expired_date;
        $borrowCard->save();
        Session::flash('success', 'The borrow card number ' . $borrowCard->card_number . ' was successfully updated!');
        return redirect('borrow-card');
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
