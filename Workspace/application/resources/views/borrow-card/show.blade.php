@extends('main')

@section('title', '| View Borrow Card')

@section('content')

    <div class="row">
    {!! Form::model($card, ['route' => ['borrow-card.update', $card->id], 'method' => 'PUT', 'data-parsley-validate' => '']) !!}
        <div class="col-md-10">
            <p>Card Number: {{ $card->card_number }}</p>
            <p class="lead">Owner: {{ $card->user->name }}</p>
            @if ($card->is_activated == 1)
                <div class="alert alert-success">This borrow card has already been activated</div>
            @else
                <div class="alert alert-danger">This borrow card has not been activated yet</div>
            @endif
            <div class="form-group required">
                {{ Form::label('expired_date', 'Expired Date', array('class' => 'control-label')) }}
                {{ Form::date('expired_date', \Carbon\Carbon::parse($card->expired_date), array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
            </div>
        </div>
        <div class="col-md-2">
            @if ($card->is_activated == 1)
                {!! Html::linkRoute('borrow-card.update', 'Deactivate borrow card', array($card->id),
                    array('class' => 'btn btn-block btn-warning', 'style' => 'margin-top: 85px;')) !!}
            @endif
            {{ Form::submit('Update borrow card', array('class' => 'btn btn-success btn-block', 'style' => 'margin-top: 56px;')) }}
        </div>
        <div class="col-md-12">
            <hr>
        </div>
    {!! Form::close() !!}
    </div>

@endsection