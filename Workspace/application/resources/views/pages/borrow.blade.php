@extends('main')

@section('title', '| Borrow book')

@section('content')
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>Register Information</b></div>

                <div class="panel-body">
                    <div class="form-group required">
                        {{ Form::label('user_name', 'User name', array('class' => 'control-label')) }}
                        {{ Form::text('user_name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                    </div>
                    <div class="form-group required">
                        {{ Form::label('book_title', 'Book title', array('class' => 'control-label')) }}
                        {{ Form::text('book_title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                    </div>
                    <div class="form-group required">
                        {{ Form::label('book_number', 'Book number', array('class' => 'control-label')) }}
                        {{ Form::text('book_number', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                    </div>
                    <div class="row" id="error-message"></div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="button" class="btn btn-info btn-lg btn-block" id="check-register-btn">Check register</button>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group required">
                        {{ Form::label('card_number', 'Card number', array('class' => 'control-label')) }}
                        {{ Form::text('card_number', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'disabled'=>'')) }}
                    </div>
                    <div class="form-group required">
                        {{ Form::label('copy_number', 'Book Copy Number', array('class' => 'control-label')) }}
                        {{ Form::text('copy_number', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'disabled'=>'')) }}
                    </div>
                    <div class="form-group required">
                        {{ Form::label('register_data', 'Register date', array('class' => 'control-label')) }}
                        {{ Form::date('register_date', null, array('class' => 'form-control', 'required' => '', 'disabled'=>'',
                        'id' => 'register_date')) }}
                    </div>
                    <div class="form-group required">
                        {{ Form::label('status', 'Status', array('class' => 'control-label')) }}
                        {{ Form::select(
                            'status',
                            ['registered' => 'Registered', 'accepted' => 'Accepted', 'lent' => 'Lent', 'finished' => 'Finished'],
                            'registered',
                            ['class' => 'form-control', 'disabled'=>'', 'id' => 'status']
                        ) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><b>Borrow book information</b></div>
                <div class="panel-body">
                    {!! Form::open(array('route' => 'borrow-book.store', 'data-parsley-validate' => '')) !!}
                        <input type="hidden" name="borrow_record_id" id="borrow_record_id">
                        <div class="form-group required">
                            {{ Form::label('status_before', 'Integrity status before', array('class' => 'control-label')) }}
                            {{ Form::textarea('status_before', null, ['class' => 'form-control', 'rows' => '3', 'required' => '']) }}
                        </div>
                        <div class="form-group required">
                            {{ Form::label('lent_date', 'Lent Date', array('class' => 'control-label')) }}
                            {{ Form::date('lent_date', null, array('class' => 'form-control', 'required' => '', 'id' => 'lent_date', 'disabled' => '')) }}
                        </div>
                        <div class="form-group required">
                            {{ Form::label('expired_date', 'Expired Date', array('class' => 'control-label')) }}
                            {{ Form::date('expired_date', null, array('class' => 'form-control', 'required' => '', 'id' => 'expired_date', 'disabled' => '')) }}
                        </div>
                        <div class="form-group required">
                            {{ Form::label('borrow_fee', 'Fee of borrow', array('class' => 'control-label')) }}
                            {{ Form::text('borrow_fee', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                        </div>
                        <div class="form-group required">
                            {{ Form::label('pre_paid', 'Pre-paid', array('class' => 'control-label')) }}
                            {{ Form::text('pre_paid', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                        </div>
                        <div style="justify-content: center; display: flex;">
                            {{ Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'width: 300px;')) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/borrow-book.js') }}"></script>
@endsection
