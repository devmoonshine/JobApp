@extends('layouts.app')

@section('content')
	<div class="container">
		Your applications: <br><br>
		@if(count($applications))
			<p class="help-block">Click on application file link to view it.</p>
			<div class="list-group">
				@foreach ($applications as $application)
					<li class="list-group-item">Email: {{ $application->email }}, application file: <a href="/manager/{{ $application->file }}">{{ $application->file }}</a> <p class="pull-right" >Posted: {{ $application->created_at->diffForHumans() }}</a></li>
				@endforeach
				<br>
			<a href="/">Back to home</a>
			</div>
		@else
			No applications so far.<br><a href="/">Want to apply?</a>
		@endif
	</div>
@endsection