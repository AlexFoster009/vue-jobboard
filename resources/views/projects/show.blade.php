@extends('layouts.app')

@section('content')
    <div class="container">
      @include('partials.header')
        <div class="project__container flex -mx-3">
            <div class="col tasks lg:w-3/4 px-3">
                <div class="mb-8">
                    <h2 class="text-grey font-normal mb-4 text-lg">Tasks</h2>
                    @forelse($project->tasks as $task)
                        <div class="card mb-3">{{ $task->body }}</div>

                    @empty
                        <p>There are no tasks created for this project.</p>
                    @endforelse
                </div>

                <div>
                    <h2 class="text-grey font-normal mb-4 text-lg">General Notes</h2>
                    <div class="notes project"></div>
                </div>


            </div>
            <div class="lg:w-1/4 px-3">
                <div class="col project">
                    <h1 class="project__title border-l-4" >{{$project->title}}</h1>
                    <div>{{$project->description}}</div>
                    <a class="mt-4 button inline-block" href="/projects">Go Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
