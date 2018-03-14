@extends('main')

@section('title', '| Return book')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><b style="font-size: 24px;">Return book</b></div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group required">
                                    {{ Form::label('user_name', 'User name', array('class' => 'control-label')) }}
                                    {{ Form::text('user_name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                                </div>
                                <div class="form-group required">
                                    {{ Form::label('card_number', 'Card Number', array('class' => 'control-label')) }}
                                    {{ Form::text('card_number', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                                </div>
                                <div class="form-group required">
                                    {{ Form::label('book_title', 'Book title', array('class' => 'control-label')) }}
                                    {{ Form::text('book_title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                                </div>
                                <div class="form-group required">
                                    {{ Form::label('book_number', 'Book number', array('class' => 'control-label')) }}
                                    {{ Form::text('book_number', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                                </div>
                                <div class="form-group required">
                                    {{ Form::label('copy_number', 'Copy number', array('class' => 'control-label')) }}
                                    {{ Form::text('copy_number', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                                </div>
                                <div class="row" id="error-message"></div>
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <button type="button" class="btn btn-info btn-lg btn-block"
                                                id="check-borrow-record-btn">Check borrow record
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {!! Form::open(array('route' => 'return-book.store', 'data-parsley-validate' => '')) !!}
                                    <input type="hidden" name="borrow_record_id" id="borrow_record_id">
                                    <div class="form-group required">
                                        {{ Form::label('status_before', 'Integrity status before', array('class' => 'control-label')) }}
                                        {{ Form::textarea('status_before', null, ['class' => 'form-control', 'rows' => '3', 'required' => '', 'disabled' => '']) }}
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
                                        {{ Form::label('returned_date', 'Return Date', array('class' => 'control-label')) }}
                                        {{ Form::date('returned_date', null, array('class' => 'form-control', 'required' => '', 'id' => 'returned_date', 'disabled' => '')) }}
                                    </div>
                                    <div class="form-group required">
                                        {{ Form::label('status_after', 'Status of returned copy', array('class' => 'control-label')) }}
                                        {{ Form::textarea('status_after', null, ['class' => 'form-control', 'rows' => '3', 'required' => '']) }}
                                    </div>
                                    <div class="form-group required">
                                        {{ Form::label('borrow_fee', 'Fee of borrow', array('class' => 'control-label')) }}
                                        {{ Form::text('borrow_fee', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'disabled' => '')) }}
                                    </div>
                                    <div class="form-group required">
                                        {{ Form::label('pre_paid', 'Pre-paid', array('class' => 'control-label')) }}
                                        {{ Form::text('pre_paid', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255', 'disabled' => '')) }}
                                    </div>
                                    <div class="form-group required">
                                        {{ Form::label('compensation_fee', 'Compensation', array('class' => 'control-label')) }}
                                        {{ Form::text('compensation_fee', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                                    </div>
                                    <div class="form-group required">
                                        {{ Form::label('total_paid', 'Total paid', array('class' => 'control-label')) }}
                                        {{ Form::text('total_paid', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
                                    </div>
                                    <div style="justify-content: center; display: flex;">
                                        {{ Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'width: 300px;')) }}
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/return-book.js') }}"></script>
@endsection
