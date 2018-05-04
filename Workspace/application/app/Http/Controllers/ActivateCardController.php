<?php

namespace App\Http\Controllers;
use App\User;
use App\BorrowCard;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ActivateCardController extends Controller {
  public function showForm()
  {
    $user = (new User())->find(Auth::user()->id);
    $borrowCard = $user->getActiveBorrowCard();
    if (is_null($borrowCard)) {
      return view('activate-card.form')
        ->with('borrowCardExist', false);
    }
    return view('activate-card.form')
      ->with('borrowCardExist', true)
      ->with('isActivated', $borrowCard->isActivated());
  }

  public function handleForm(Request $request)
  {
    $user = (new User())->find(Auth::user()->id);
    $borrowCard = $user->getActiveBorrowCard();
    if ($borrowCard->activation_code != $request->activation_code) {
      Session::flash('fail', 'The activation code is incorrect');
      return redirect()->back();
    }
    $borrowCard->is_activated = true;
    $borrowCard->save();
    Session::flash('success', 'The borrow card was successfully activated!');
    return redirect()->back();
  }
}