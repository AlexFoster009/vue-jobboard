@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="flex items-center mb-3 py-4">
            <div class="flex justify-between items-center w-full">
                <div class="breadcrumbs">
                    <p> <a href="/projects">My Projects</a></p>
                </div>
                <br>
                <a class="button" href="{{route('projects.create')}}">New Project</a>
            </div>
        </header>
        <main class="container flex flex-wrap -mx-3">
            @forelse($projects as $project)
                <div class="w-1/3 px-3 pb-6">
                    @include('partials.card')
                </div>
            @empty
                <div>Sorry, there are no projects yet.</div>
            @endforelse
        </main>
    </div>
@endsection
