@extends('main')

@section('title', '| All books')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>All Books</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('book.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create new
                book</a>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    </div> <!-- end of .row -->
    <div class="row">
        {{ $books->links() }}
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <th>Book number</th>
                <th>Title</th>
                <th>Authors</th>
                <th>Publisher</th>
                <th>Category</th>
                <th>Number of Copies</th>
                <th>Created At</th>
                </thead>

                <tbody>

                @foreach ($books as $book)

                    <tr>
                        <th>{{ $book->book_number }}</th>
                        <td><a href="{{ route('book.show', $book->id) }}">{{ $book->title }}</a></td>
                        <td>{{ $book->authors }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->category }}</td>
                        <td>{{ $book->copies()->count() }}</td>
                        <td>{{ date('M j, Y', strtotime($book->created_at)) }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        {{ $books->links() }}
    </div>
@stop