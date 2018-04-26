@extends('main')

@section('title', '| Manage Borrowing Cards')

@section('content')
    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-6">
              @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
              @endif

              {!! Form::open(array('route' => 'borrow-card.search', 'data-parsley-validate' => '')) !!}

              <div class="form-group required">
                  {{ Form::text('searchTerm', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
              </div>
              {{ Form::submit('Search', array('class' => 'btn btn-success')) }}
              {!! Form::close() !!}

              <hr />

            </div>
            <div class="col-md-6">
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <th>Card Number</th>
                    <th>Owner</th>
                    <th>Activated ?</th>
                    <th>Expired Date</th>
                    </thead>

                    <tbody>

                    @foreach ($cards as $card)

                        <tr>
                            <td><a href="{{ route('borrow-card.show', $card->id) }}">{{ $card->card_number }}</a></td>
                            <td>{{ $card->user->name }}</td>
                            <td>{{ $card->is_activated == 1 ? 'True' : 'False' }}</td>
                            <td>{{ date('M j, Y', strtotime($card->expired_date)) }}</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                {!! Html::linkRoute('issue-card.create', 'Issue new borrowing card', null,
                    array('class' => 'btn btn-primary')) !!}
            </div>
        </div>
    </div>
@endsection