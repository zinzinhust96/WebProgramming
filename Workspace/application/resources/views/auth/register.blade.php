@extends('main')

@section('script')
    <script>
        function valueChanged() {
            if ($('#is_student').is(':checked')) {
                console.log('abcxyz');
                $( "#student_info" ).prop( "disabled", false );
            } else {
                $( "#student_info" ).prop( "disabled", true );
            } 
        }
    </script>
@show

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                            <label for="full_name" class="col-md-4 control-label">Full Name</label>

                            <div class="col-md-6">
                                <input id="full_name" class="form-control" name="full_name" value="{{ old('full_name') }}" required>

                                @if ($errors->has('full_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                            <select name="gender" class="form-control">
                                <option value="F">Female</option>
                                <option value="M">Male</option>
                            </select>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                            <label for="contact" class="col-md-4 control-label">Contact number</label>

                            <div class="col-md-6">
                                <input id="contact" class="form-control" name="contact" value="{{ old('contact') }}" required>

                                @if ($errors->has('contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr />

                        <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                            <label for="contact" class="col-md-4 control-label">Is HUST Student ?</label>

                            <div class="col-md-6">
                                <input id="is_student" type="checkbox" name="is_student" value="student">
                            </div>
                        </div>

                        <div id="student_info" style="display:none;">
                            <div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }}">
                                <label for="student_id" class="col-md-4 control-label">Student ID</label>

                                <div class="col-md-6">
                                    <input id="student_id" class="form-control" name="student_id">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('expired_at') ? ' has-error' : '' }}">
                                <label for="expired_at" class="col-md-4 control-label">Expired at</label>

                                <div class="col-md-6">
                                    <input id="expired_at" class="form-control" name="expired_at">
                                </div>
                            </div>
                        </div>
                        
                        <hr />

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
