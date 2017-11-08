@extends('layouts.app')
@section('content')
    <div class="row center-align">
        <img src="/img/IJSBOERKE.png" width="300">
    </div>
    <div class="main row red center-align extra-margin-top">
        <h5 class="white-text">Thank you for competing in {{ $contest->name }}!</h5>
        <p class="white-text">Check your mails to see if you've won!</p>

    </div>
@endsection
@section('scripts')

@endsection