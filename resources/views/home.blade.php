@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Subscribe to service</div>

                <div class="panel-body">

                    @if(count($errors))
                        @include('errors')
                    @endif

                    <a href="/manager" class="btn btn-primary" role="button">View your applications</a> </br></br>

                    <form method="post" action="{{ route('apply') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                      <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                      </div>
                      <div class="form-group">
                        <label for="file">Upload your file</label>
                        <input type="file" id="file" name="file" required>
                      </div>
                      <button type="submit" class="btn btn-default">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
