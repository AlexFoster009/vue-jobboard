@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="project">
            <h1 class="project__title">{{$project->title}}</h1>
            <p class="project__description">{{$project->descripton}}</p>
            <a href="/projects">Go back</a>
        </div>
    </div>
@endsection
