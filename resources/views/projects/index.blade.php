@extends('layouts.app')

@section('content')
    <div class="container">
      @include('partials.header')
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
