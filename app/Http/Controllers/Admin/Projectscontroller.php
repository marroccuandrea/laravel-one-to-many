<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Functions\Helper as Help;

class Projectscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist = Project::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.projects.index')->with('error', 'Progetto già esistente');
        } else {
            $new = new Project();
            $new->title = $request->title;
            $new->slug = Help::generateSlug($new->title, Project::class);
            $new->save();
            return redirect()->route('admin.projects.index')->with('success', 'Progetto creato correttamente');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate(
            [
                'title' => 'required|min:3|max:255',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.max' => 'Il titolo non può superare i :max caratteri',
                'title.min' => 'Il titolo deve avere almeno :min caratteri',

            ]
        );
        $exist = Project::where('title', $request->title)->first();
        if ($exist) {
            return redirect()->route('admin.projects.index')->with('error', 'Progetto già esistente');
        } else {
            $data['slug'] = Help::generateSlug($request->title, Project::class);
            $project->update($data);
            return redirect()->route('admin.projects.index')->with('success', 'Progetto modificato correttamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato correttamente');
    }
}
