@extends('app')

@section('body')
    <div class="row justify-content-md-center">
        <div class="col col-md-4">
            <br>
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Login</h5>
                <form method="post" action="{{route('login')}}">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" required class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" required class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    @if(Request::input('loginError'))
                        <div class="alert alert-danger" role="alert">Login error</div>
                    @endif
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
