@extends('main')

@section('title', '| Activate Borrow Card')

@section('content')
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-6">
            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
            @if ($borrowCardExist)
                @if (!$isActivated)
                    <h1>Enter borrowing card activation code below: </h1>
                    {!! Form::open(array('route' => 'activate-card.handleForm', 'data-parsley-validate' => '')) !!}

                    <div class="form-group required">
                        {{ Form::text('activation_code', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                    </div>
                    {{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
                    {!! Form::close() !!}
                @else 
                    <h1>You have already activated your borrowing card</h1>
                @endif
            @else
                <h1>You have not had a borrow card yet. Please go to the library to be issued borrowing cards</h1>
            @endif
                <hr />

                
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
@endsection