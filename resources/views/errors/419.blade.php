@extends('errors.layout')

@section('content')
    <div class="ex-page-content text-center">
        <div class="text-error"><span class="text-primary">4</span><span class="text-pink">1</span><span class="text-info">9</span></div>
        <h2>Fraudulent Request</h2><br>
        <p class="text-muted">You made a request pertaining to fraud</p>
        <br>
        <a class="btn btn-default waves-effect waves-light" href="/dashboard"> Return Home</a>
    </div>
@endsection