<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id')->paginate(15);
        return view('book.index')->withBooks($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, array(
            'title' => 'required|unique:books|max:255',
            'publisher' => 'required|max:255',
            'authors' => 'required|max:255',
            'category' => 'in:textbook,history,dictionary,poetry,biography',
            'isbn' => 'required|unique:books|max:255',
        ));

        $bookCategory = ucfirst($request->category);

        // store in the database
        $book = new Book();
        $bookNumber = $book->generateBookNumber($bookCategory);
        $book->createNewBook($bookNumber, $request->title, $request->publisher, $request->authors, $bookCategory, $request->isbn);
        Session::flash('success', 'The book was successfully save!');
        return redirect()->route('book.show', $book->getAttribute('id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = (new Book())->find($id);
        return view('book.show')->withBook($book);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
