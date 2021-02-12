<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        /*
         * Since there is a relationship between users and Project
         * we can get all of the authenticated users projects by
         * setting $projects to the Auth users projects.
         */
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Project $project)
    {

        if(auth()->id() !== (int) $project->owner_id){
            abort(403);
        }

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
       request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

      $project = auth()->user()->projects()->create();

        return redirect($project->path());
    }
}
