@extends('main')

@section('title', '| View Book')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>{{ $book->title }}</h1>

            <p class="lead">{{ $book->authors }}</p>
            <p>{{ $book->publisher }}</p>
            <span>{{ $book->category }} - {{ $book->book_number }}</span>
        </div>
        @role(['admin', 'librarian'])
            <div class="col-md-2">
                {!! Html::linkRoute('book.copy.create', 'Create new copy', array($book->id),
                    array('class' => 'btn btn-lg btn-block btn-primary btn-h1-spacing')) !!}
            </div>
        @endrole
        <div class="col-md-12">
            <hr>
        </div>

        <div class="row">
            <div class="col-md-12">
                <b>Number of copies: {{ $book->number_of_copies() }}</b>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <th>#</th>
                    <th>Type of copy</th>
                    <th>Price</th>
                    <th>Copy status</th>
                    <th>Created At</th>
                    </thead>

                    <tbody>

                    @foreach($book->copies as $copy)

                        <tr>
                            <th>{{ $copy->copy_number }}</th>
                            <td>{{ $copy->type_of_copy }}</td>
                            <td>{{ $copy->price }}</td>
                            <td>{{ $copy->copy_status }}</td>
                            <td>{{ date('M j, Y', strtotime($copy->created_at)) }}</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection