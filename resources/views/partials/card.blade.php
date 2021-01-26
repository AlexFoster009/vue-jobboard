<div class="w-1/3 px-3 pb-6">
    <div class="project p-5 rounded-lg shadow bg-white h-full" >
        <h3 class="project__title font-normal text-xl py-4 mb-3 -ml-5 border-l-4 border-blue pl-4">
            <a class="text-black no-underline" href="{{$project->path()}}">
                {{$project->title}}
            </a>
        </h3>
        <p class="text-grey">{{ \Str::limit($project->description, 90) }}</p>
    </div>
</div>
