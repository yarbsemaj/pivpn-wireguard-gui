@extends('app')

@push('scripts')
    <script src="{{url('/js/qrcode.min.js')}}"></script>
@endpush

@section('body')
    @if(Request::input('new'))
        <br>
            <div class="alert alert-success" role="alert">Profile '{{$profile->name}}' created</div>
    @else
        <br>
    @endif
    <div class="row justify-content-md-center">
        <div class="col col-md-12 my-auto">
            <div class="card">
                <div class="card-header">
                    {{$profile->name}}
                </div>
                <div class="card-body">
                    <div class="row">
                <div class="col col-lg-4 text-center">
                    <div id="qrcode" class="d-flex justify-content-center"></div>
                    <div class="btn-group" role="group">
                        <a href="{{route('profile.download',['name'=>$profile->name])}}" type="button" class="btn btn-primary">Download</a>
                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#remove-profile">Revoke</a>
                    </div>
                </div>
                    <div class="col col-lg-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Public Key: </b> <code>{{$profile->public_key}}</code></li>
                            <li class="list-group-item"><b>Creation Date: </b> {{$profile->created_date}}</li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="remove-profile" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Remove Profile</h5>
                </div>
                    <div class="modal-body">
                        Are you sure you want to revoke '{{$profile->name}}'?
                    </div>
                    <div class="modal-footer">
                        <button id="submit" data-profile="{{$profile->name}}" class="btn btn-danger">Do it!</button>
                        <button id="loading" style="display: none" class="btn btn-danger" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                        <button class="btn btn-secondary" data-dismiss="modal">Narr</button>
                    </div>
            </div>
        </div>
    </div>
    <script>
        new QRCode(document.getElementById("qrcode"), `{{$profile->raw}}`);
    </script>
@endsection
