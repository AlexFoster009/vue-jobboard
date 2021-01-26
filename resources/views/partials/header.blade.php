<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between items-center w-full">
        <div class="breadcrumbs">
            <p> <a href="/projects">My Projects</a> / {{$project->title}}</p>
        </div>
        <br>
        <a class="button" href="{{route('projects.create')}}">New Project</a>
    </div>
</header>
