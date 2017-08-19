@extends('layouts.app')
@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">You have competed in {{ $contest->name }}</div>

            <div class="panel-body">
                Thank you for competing!
            </div>
        </div>
    </div>
@endsection