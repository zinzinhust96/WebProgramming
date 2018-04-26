@extends('main')

@section('title', '| Register To Borrow Book')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 style="text-align: center">List of Books</h1>
            </div>
            <div class="panel-body">
                <div class="book-list" id="book-list">
                    @include('book-borrow-registration._book_index')
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <a href="/" class="btn btn-danger btn-lg btn-block">Back</a>
                    </div>
                    <div class="col-md-3 col-md-offset-6">
                        <button type="button" class="btn btn-success btn-lg btn-block"
                                id="open-register-modal">Register
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="borrow-modal" tabindex="-1" role="dialog"
         aria-labelledby="Register to Borrow Book">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            id="close-modal">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-title">Register to Borrow Book</h4>
                </div>
                <div class="modal-body">
                    <div class="row jumbotron">
                        <form action="{{ route('book.borrow.register.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="user-name" class="form-label">Borrower's Name:</label>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" name="user-name" id="user-name" value="{{ Auth::user()->name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="borrow-card" class="form-label">Borrow Card:</label>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" name="borrow-card" id="borrow-card">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="password-confirmation" class="form-label">Password Confirmation:</label>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" name="password-confirmation" id="password-confirmation" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="borrowed-date" class="form-label">Borrowed Date: </label>
                                </div>
                                <div class="col-md-5">
                                    <input class="form-control" name="borrowed-date" id="borrowed-date" value="{{ (new DateTime())->format('d/m/Y H:i:s') }}" disabled>
                                </div>
                            </div>
                            <input type="hidden" name="book-ids">
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Authors</th>
                                    <th>Publisher</th>
                                    <th>Number of Available Copies</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="open-borrow-modal-button">Submit</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/book-borrow-registration.js') }}"></script>
@endsection