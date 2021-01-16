@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-3">
        <h1 class="mr-auto">Laravel Job Board</h1>
        <a href="{{route('projects.create')}}">New Project</a>
    </div>
    <div class="container flex">
       @forelse($projects as $project)
            <div class="project mr-4 p-5 rounded shadow bg-white w-1/3" style="height: 200px;">
                <h3 class="font-normal text-xl py-4">{{$project->title}}</h3>
                <p class="text-grey">{{ str_limit($project->description, 250) }}</p>
            </div>
        @empty
           <div>Sorry, there are no projects yet.</div>
        @endforelse
    </div>

@endsection
