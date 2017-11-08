@extends('layouts.admin')
@section('content')
    <div class="container">
        @foreach($contests as $contest)
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $contest->name }} contestants</div>
                        <div class="panel-body">
                            <table>
                                <tr>
                                    <td class="black-text">First name</td>
                                    <td class="black-text">Last name</td>
                                    <td class="black-text">Ip address</td>
                                    <td class="black-text">Delete</td>
                                </tr>
                                @foreach($contest->users()->get() as $user)
                                    <tr>
                                        <td>{{ $user->firstName }}</td>
                                        <td>{{ $user->lastName }}</td>
                                        <td>{{ $user->ipaddress }}</td>
                                        <td><a href="deleteUser/{{$user->id}}">Delete</a></td>
                                    </tr>
                                @endforeach
                            </table>
                            <ul>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endforeach
@endsection