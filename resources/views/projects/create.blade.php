@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="project__form">
            <form class="form" method="POST" action="{{route('projects')}}">
                @csrf
                <div class="form-group">
                    <label for="title">Title:
                        <input type="text" placeholder="Enter Title"/>
                    </label>
                    <label for="title">Description:
                        <textarea name="" id="" cols="30" rows="10"></textarea>
                    </label>

                </div>
                <input type="submit" value="Submit">

            </form>
        </div>
    </div>

@endsection
