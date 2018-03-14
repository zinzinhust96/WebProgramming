@extends('main')

@section('title', '| Add New Book')

@section('content')
    <div class="container container-fluid">
        <h1 style="text-align: center">Create New Book</h1>
        {!! Form::open(array('route' => 'book.store', 'data-parsley-validate' => '')) !!}

        <h3>Book Information</h3>
        <div class="form-group required">
            {{ Form::label('title', 'Title', array('class' => 'control-label')) }}
            {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
        </div>
        <div class="form-group required">
            {{ Form::label('publisher', 'Publisher', array('class' => 'control-label')) }}
            {{ Form::text('publisher', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
        </div>
        <div class="form-group required">
            {{ Form::label('authors', 'Authors', array('class' => 'control-label')) }}
            {{ Form::text('authors', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
        </div>
        <div class="form-group required">
            {{ Form::label('category', 'Category', array('class' => 'control-label')) }}
            {{ Form::select('category', ['textbook' => 'Textbook', 'history' => 'History', 'dictionary' => 'Dictionary', 'poetry' => 'Poetry', 'biography' => 'Biography'], 'textbook', ['class' => 'form-control']) }}
        </div>
        <div class="form-group required">
            {{ Form::label('isbn', 'ISBN', array('class' => 'control-label')) }}
            {{ Form::text('isbn', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
        </div>
        <div class="row">
            <div class="col-md-6">
                {{ Form::submit('Create Book', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
            </div>
            <div class="col-md-6">
                {!! Html::linkRoute('book.index', 'Cancel', null, array('class' => 'btn btn-danger btn-lg btn-block', 'style' => 'margin-top: 20px;')) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@endsection