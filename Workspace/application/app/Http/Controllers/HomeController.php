<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('title')->paginate(10);
        $newBooks = Book::orderBy('created_at')->limit(5)->get();
        $recentBooks = Book::orderBy('updated_at')->limit(5)->get();

        return view('pages.home')->with([
            'books' => $books,
            'newBooks' => $newBooks,
            'recentBooks' => $recentBooks
        ]);
    }

    public function show()
    {
        return view('pages.about');
    }

    public function borrow()
    {
        return view('pages.borrow');
    }

    public function return()
    {
        return view('pages.return');
    }
}
