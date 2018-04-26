<?php

namespace App\Http\Controllers;
use App\User;
use App\BorrowCard;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class IssueCardController extends Controller
{
    public function searchUser(Request $request)
    {
        $user = (new User())->getUserByUsername($request->input('name'));
        if (is_null($user)) {
            return view('issue-card.search-user')
                ->with('userNotFound', true);
        }
        return redirect()->route('issue-card.user-detail', $user->id);
    }

    public function userDetail($userId){
        $user = (new User())->getUserByUserID($userId);
        $borrowCard = $user->getActiveBorrowCard();            
        return view('issue-card.detail')
                ->with('user', $user)
                ->with('borrowCard', $borrowCard);
    }

    public function create()
    {
        return view('issue-card.search-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $borrowCard = new BorrowCard();
        $user = (new User())->getUserByUserID($request->user_id);
        if(!is_null($request->paid) && $request->paid == 'paid') {
            $borrowCard->createNewBorrowCard($request->user_id);
        }
        if(!is_null($request->student_id)) {
            if($user->is_student && $request->student_id == $user->student_id){
                $borrowCard->createNewBorrowCard($request->user_id);        
            } else {
                Session::flash('fail', 'You have given a wrong student ID!');
                return redirect()->route('issue-card.user-detail', $user->id);
            }
        }
        Session::flash('success', 'The borrow card was successfully created!');
        return view('issue-card.detail')
            ->with('user', $user)
            ->with('borrowCard', $borrowCard);
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
