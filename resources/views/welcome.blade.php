@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height blue extra-margin-bottom">
        <div class="container center-align">
            <div class="title row white-text">
                More icecream!
            </div>
            <div class="row">
                by
            </div>
            <div class="row">
                <img src="/img/IJSBOERKE.png" width="300px">
            </div>
            <div class="row white-text">
                <h5>
                    Monthly contest for a year of IJSBOERKE's icecream for free!
                </h5>
                <p>
                    Enter the codes from your used IJSBOERKE's products and get more chances to win!
                </p>
            </div>

            <a href="{{ url('/compete') }}" class="red-text">

            <div class="btn-large yellow red-text large extra-margin-bottom extra-margin-top">
                Compete!
            </div>
            </a>

            <div class="bottom-text">
                <p class="white-text">See the previous winners! </p>

                <i class="material-icons white-text">arrow_downward</i>
            </div>

        </div>
    </div>
    @foreach($contests as $contest)
        @if($contest->active == false && $contest->winner_id != null)
            <div class="row center-align">
                <div class="col s10 offset-s1 l6 offset-l3 red">
                    <h5 class="white-text">{{ $contest->name }}</h5>
                    <p class="white-text">Winner: {{ \App\User\User::find($contest->winner_id)->firstName }} {{ \App\User\User::find($contest->winner_id)->lastName }}</p>
                </div>
            </div>
        @endif
    @endforeach
@endsection
