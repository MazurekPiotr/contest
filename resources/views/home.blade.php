@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($runningContests as $contest)
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Running contest</div>

                    <div class="panel-body">
                        <div>{{ $contest->description }}</div>
                        <a href="/compete/{{$contest->id}}">Compete</a>
                    </div>
                </div>
            </div>
        <div class="col-md-8 col-md-offset-2">
        </div>
        @endforeach
        @foreach($endedContests as $contest)
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $contest->name }} ended</div>

                    <div class="panel-body">
                        Winner is: {{ $contest->winner($contest->winner_id)->firstName }} from {{ $contest->winner($contest->winner_id)->country }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection