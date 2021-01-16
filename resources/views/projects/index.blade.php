@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-3">
        <h1 class="mr-auto">Laravel Job Board</h1>
        <a href="/projects/create">New Project</a>
    </div>
    <div class="container">
       @forelse($projects as $project)
            <div class="project">
                <h2>{{$project->title}}</h2>
                <p>{{$project->description}}</p>
            </div>
        @empty
           <p>Sorry, there are no projects yet.</p>
        @endforelse
    </div>

@endsection
