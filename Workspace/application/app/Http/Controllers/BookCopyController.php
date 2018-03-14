<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\BookCopy;
use Illuminate\Support\Facades\Session;

class BookCopyController extends Controller
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
     * @param $book_id
     * @return \Illuminate\Http\Response
     */
    public function create(int $book_id)
    {
        $book = (new Book())->find($book_id);

        if (is_null($book)) {
            return abort(404, "Page not found!");
        }

        return view('copy.create')->with('book', $book);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $book_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $book_id, Request $request)
    {
        // validate the data
        $this->validate($request, array(
            'number_of_copies' => 'required|numeric',
            'price' => 'required|numeric',
            'type_of_copy' => 'in:borrowable,referenced'
        ));

        $book = (new Book())->find($book_id);

        if (is_null($book)) {
            Session::flash('fail', 'The book_id attribute is not valid!');

            return redirect()->back();
        }

        for($i = 1; $i <= $request->input('number_of_copies'); $i++){
            $copy = new BookCopy();
            $copy->createNewCopyForBook($book, $request);
        }

        $book->updateNumberOfCopies();
        Session::flash('success', 'The copies was successfully added!');

        return redirect()->route('book.show', $book_id);
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
        return view('copy.edit')->with('book_id', $id);
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
