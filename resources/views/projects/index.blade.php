@extends('layouts.app')

@section('content')
    <div class="container">
      @include('partials.header')
        <main class="container flex flex-wrap -mx-3">
            @forelse($projects as $project)
                @include('partials.card')
            @empty
                <div>Sorry, there are no projects yet.</div>
            @endforelse
        </main>
    </div>
@endsection
