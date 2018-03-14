@extends('main')

@section('title', '| Home page')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <div class="row">
            @if (session('status'))
                <div class="col-md-10 col-md-offset-1 alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">Book List</div>

                    <div class="panel-body">
                        @role('borrower')
                        <div class="float-right">
                            <a href="{{ route('book.borrow.register.create') }}" class="btn btn-info">
                                Register to Borrow</a>
                        </div>
                        @endrole
                        @include('layouts.home-page.book-list')
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">New Books</div>

                    <div class="panel-body">
                        @include('layouts.home-page.new-books')
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Recently Borrow</div>

                    <div class="panel-body">
                        @include('layouts.home-page.recently-borrow')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
