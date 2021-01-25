@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-3">
        <h1 class="mr-auto">Laravel Job Board</h1>
        <a href="{{route('projects.create')}}">New Project</a>
    </div>
    <div class="container flex flex-wrap -mx-3">
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
    </div>

@endsection
