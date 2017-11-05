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
                        <p>{{ $contest->end_date }}</p>
                        <a href="/compete/{{$contest->id}}">Compete</a>
                    </div>
                </div>
            </div>
        <div class="col-md-8 col-md-offset-2">
        </div>
        @endforeach
    </div>
</div>
@endsection
