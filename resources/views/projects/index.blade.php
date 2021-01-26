@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="flex items-center mb-3 py-4">
            <div class="flex justify-between items-center w-full">
                <h1 class="text-sm text-grey text-normal">My Projects</h1>
                <br>
                <a class="button" href="{{route('projects.create')}}">New Project</a>
            </div>
        </header>
        <main class="container flex flex-wrap -mx-3">
            @forelse($projects as $project)
                <div class="w-1/3 px-3 pb-6">
                    <div class="project p-5 rounded shadow bg-white " style="height: 200px;">
                        <h3 class="font-normal text-xl py-4">{{$project->title}}</h3>
                        <p class="text-grey">{{ \Str::limit($project->description, 250) }}</p>
                    </div>
                </div>
            @empty
                <div>Sorry, there are no projects yet.</div>
            @endforelse
        </main>
    </div>
@endsection
