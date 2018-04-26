@extends('main')

@section('title', '| Issue Borrowing Card')

@section('content')
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-6">
            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif
                <h1>User detail</h1>
                <p>Full name: {{ $user->full_name }}</p>
                <p>Borrow card status: {{ isset($borrowCard) ? 'User had already had borrowing card' : 'User did not have borrowing card' }}</p>
                <p>Type: {{ $user->is_student ? 'Student' : 'Not student' }}</p>
                <hr>

                @if(!isset($borrowCard))
                  <h1>Issue card validation form</h1>
                  {!! Form::open(array('route' => 'issue-card.store', 'data-parsley-validate' => '')) !!}
                  {{ Form::hidden('user_id', $user->id) }}
                  @if($user->is_student)
                    <div class="form-group required">
                        {{ Form::label('student_id', 'Student ID', array('class' => 'control-label')) }}
                        {{ Form::text('student_id', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                    </div>
                  @else
                    <span>Ask user to pay 200,000 VND as deposit</span>
                    <div class="form-group required">
                        {{ Form::label('paid', 'Paid', array('class' => 'control-label')) }}
                        <input type="checkbox" name="paid" value="paid" required>
                    </div>
                  @endif

                  {{ Form::submit('Validate', array('class' => 'btn btn-success')) }}
                  {!! Form::close() !!}

                  <hr />
                @else
                    <h1>Issued card information</h1>
                    <p>Card number: {{ $borrowCard->card_number }}</p>
                    <p>Expired date: {{ date_format(date_create($borrowCard->expired_date), "F d, Y G:i") }}</p>
                    <p>Activation code: {{ $borrowCard->activation_code }}</p>
                @endif

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