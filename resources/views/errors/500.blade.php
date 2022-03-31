@extends('errors.layout')

@section('content')
    <div class="ex-page-content text-center">
        <div class="text-error"><span class="text-primary">4</span><i class="ti-face-sad text-pink"></i><span
                    class="text-info">4</span></div>
        <h2>An error occured</h2><br>
        <p class="text-muted">Please contact site administration for support</p>
        <br>
        <a class="btn btn-default waves-effect waves-light" href="/dashboard"> Return Home</a>
    </div>
@endsection