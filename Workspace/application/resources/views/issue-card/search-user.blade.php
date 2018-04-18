@extends('main')

@section('title', '| Issue Borrowing Card')

@section('content')
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-6">
            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
                <h1>Search user</h1>
                {!! Form::open(array('route' => 'issue-card.searchUser', 'data-parsley-validate' => '')) !!}

                @if(isset($userNotFound) && $userNotFound == true)
                    <span class="col-sm-12 alert alert-danger">User did not exist</span>
                @endif

                <div class="form-group required">
                    {{ Form::label('name', 'Username', array('class' => 'control-label')) }}
                    {{ Form::text('name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                </div>
                {{ Form::submit('Search', array('class' => 'btn btn-success')) }}
                {!! Form::close() !!}

                <hr />

                <div class="form-group required">
                <h1>Click reset to clear all form</h1>
                {!! Html::linkRoute('issue-card.create', 'Reset', null, array('class' => 'btn btn-danger')) !!}
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
@endsection