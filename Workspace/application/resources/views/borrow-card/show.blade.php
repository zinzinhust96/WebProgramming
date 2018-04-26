@extends('main')

@section('title', '| View Borrow Card')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <p>Card Number: {{ $card->card_number }}</p>
            <p class="lead">Owner: {{ $card->user->name }}</p>
            <p>Activation code: {{ $card->activation_code }}
            {!! Form::model($card, ['route' => ['borrow-card.update', $card->id], 'method' => 'PUT', 'data-parsley-validate' => '']) !!}
                <div class="form-group required">
                    {{ Form::label('expired_date', 'Expired Date', array('class' => 'control-label')) }}
                    {{ Form::date('expired_date', \Carbon\Carbon::parse($card->expired_date), array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                </div>
                {{ Form::submit('Update borrow card', array('class' => 'btn btn-success')) }}
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            @if ($card->is_activated == 1)
                <div class="alert alert-success">This borrow card has already been activated</div>
                {!! Html::linkRoute('borrow-card.deactivate', 'Deactivate borrow card', array($card->id),
                array('class' => 'btn btn-warning', 'style' => 'float: right;')) !!}
            @else
                <div class="alert alert-danger">This borrow card has not been activated yet</div>
            @endif
        </div>
    </div>

@endsection