@extends('layouts.app')
@section('content')
    <div class="row center-align">
        <img src="img/IJSBOERKE.png" width="300">
    </div>
    @foreach($contests->reverse() as $contest)
        @if($contest->active == true)
            <div class="main row red">
                <h5 class="text-center white-text">{{ $contest->name }}</h5>
                <p class="text-center white-text">{{ $contest->description }}</p>
                <form class="col l6 offset-l3 center-align s12 blue" action="{{ url('/compete/' . $contest->id) }}" method="POST">
                    {{ csrf_field() }}
                    @if ($errors->has('code'))
                        <span class="help-block">
                            <strong class="red-text">{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                    <div class="row center-align extra-margin-top">
                        <div class="col s8 offset-s2 white">
                            <div class="input-field col s12 black-text-text">
                                <input id="code" type="text" name="code" class="validate" value="{{ old('code') }}" >
                                <label for="code" class="black-text text-center">Code</label>
                            </div>
                        </div>
                    </div>
                    <div class="row center-align">
                        <div class="col s8 offset-s2 white">
                            <div class="input-field col s12 black-text">
                                <input id="first_name" type="text" name="first_name" class="validate" value="{{ old('first_name') }}">
                                <label for="first_name" class="black-text">First Name</label>
                            </div>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row center-align">
                        <div class="col s8 offset-s2 white">
                            <div class="input-field col s12 black-text">
                                <input id="last_name" type="text" name="last_name" class="validate" value="{{ old('last_name') }}">
                                <label for="last_name" class="black-text">Last Name</label>
                            </div>
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                <strong class="red-text">{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row center-align">
                        <div class="col s8 offset-s2 white">
                            <div class="input-field col s12 black-text">
                                <input id="email" type="email" name="email" class="validate">
                                <label for="email" class="black-text">Email</label>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong class="red-text">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light extra-margin-bottom yellow red-text" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </form>
            </div>
        @endif
    @endforeach


@endsection
@section('scripts')

@endsection