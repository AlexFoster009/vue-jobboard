<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        if(auth()->user() != $project->owner){
            abort(403);
        }
        $attributes = request()->validate(['body' => 'required']);
        $project->addTask($attributes);

        return redirect($project->path());
    }
}
