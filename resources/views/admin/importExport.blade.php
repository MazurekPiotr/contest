@extends('layouts.admin')
@section('content')
<div class="container">
    <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download all entries</button></a>
    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="row">
            <input type="file" name="import_file" />
        </div>
        <div class="row">
            @if (session('added'))
                <div class="alert alert-success">
                    {{ session('added') }}
                </div>
            @endif
            <div class="input-field col s8">

                <select name="contest" id="contest">
                    @foreach($contests as $contest)
                        <option value="{{ $contest->id }}">{{ $contest->name }}</option>
                    @endforeach
                </select>

                <label for="contest">Contest: </label>
            </div>
        </div>


        {{ csrf_field() }}
        <div class="row">
            <button class="btn btn-primary">Import File</button>
        </div>
    </form>
    <p></p>
    @foreach($contests as $contest)
        <a href="{{ url('downloadExcel/contest/xls/'.$contest->id) }}"><button class="btn btn-success">Download Excel from {{ $contest->name }}</button></a><br>
        <p></p>
    @endforeach
</div>
    @endsection