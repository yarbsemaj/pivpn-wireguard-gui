@extends('app')

@section('body')
    @if(Request::input('removed'))
        <br>
        <div class="alert alert-danger" role="alert">Profile '{{Request::input('removed')}}' removed</div>
    @else
        <br>
    @endif
    <div class="row justify-content-md-center">
        <div class="col col-lg-6 my-auto">
            <div class="jumbotron">
                <h1 class="display-4">Welcome back, {{Auth::user()->username}}!</h1>
            </div>
        </div>
        <div class="col col-lg-6 my-auto">
            <button class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#add-profile">
                Add profile <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7.5 1.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V11a.5.5 0 0 0 1 0V9.5H10a.5.5 0 0 0 0-1H8.5V7z"/>
                </svg>
            </button>
        </div>
    </div>
    <br>
    <div class="row justify-content-md-center">
        <div class="col col-md-12 my-auto">
            <div class="card">
                <div class="card-header">
                    Profiles
                </div>
                <div class="card-body">
                    @if ($profiles->isEmpty())
                        <h2>No Profiles</h2>
                    @else
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="d-none d-lg-table-cell">Public Key</th>
                                <th scope="col">Creation Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($profiles as $profile)
                                <tr>
                                    <th>
                                        <a href="{{route('profile.get',['name'=>$profile->name])}}">{{$profile->name}}</a>
                                    </th>
                                    <td class="d-none d-lg-table-cell">{{$profile->public_key}}</td>
                                    <td>{{$profile->created_date}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row justify-content-md-center">
        <div class="col col-md-12 my-auto">
            <div class="card">
                <div class="card-header">
                    Clients
                </div>
                <div class="card-body">

                    @if ($clients->isEmpty())
                        <h2>No Clients</h2>
                    @else
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col" class="d-none d-lg-table-cell">External IP</th>
                                <th scope="col" class="d-none d-lg-table-cell">Internal IP</th>
                                <th scope="col">Up</th>
                                <th scope="col">Down</th>
                                <th scope="col" class="d-none d-lg-table-cell">Last Connected</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <th>{{$client->name}}</th>
                                    <td class="d-none d-lg-table-cell">{{$client->external_IP}}</td>
                                    <td class="d-none d-lg-table-cell">{{$client->internal_IP}}</td>
                                    <td>{{$client->upload}}</td>
                                    <td>{{$client->download}}</td>
                                    <td class="d-none d-lg-table-cell">{{$client->last_connected}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add-profile" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addProfileFrom">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="profileName">Profile name</label>
                        <input type="text" required class="form-control" id="profileName">
                        <small id="profileNameHelp" class="form-text text-muted">Name can only contain alphanumeric characters and these characters (.-@_)</small>
                        <div id="profileNameValidation" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit" type="submit" class="btn btn-primary">Add</button>
                    <button id="loading" style="display: none" class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
