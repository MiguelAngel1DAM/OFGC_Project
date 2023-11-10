<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;

class ProjectController extends Controller
{
    public function index() 
    {
        $projects = Projects::all();
        
        return response()->json($projects);
    }

    public function store(Request $request)
    {
        $project = new Projects;
        $project->PlayListId = $request->PlayListId;
        $project->Season = $request->Season;
        $project->ProjectNote = $request->ProjectNote;
        $project->ProjectDateIni = $request->ProjectDateIni;
        $project->ProjectDateEnd = $request->ProjectDateEnd;
        $project->ProjectRevision = $request->ProjectRevision;
        $project->save();

        return response()->json([
            "message" => "success",
            "data" => $project
        ], 201);
    }

    public function show($id)
    {
        $project = Projects::find($id);

        if (!empty($project)) {
            return response()->json($project);
        } else {
            return response()->json([
                "message" => "error"
            ], 404);
        }        
    }

    public function update(Request $request, $id)
    {
        if (Projects::where('id', $id)->exists()) {
            $project = Projects::find($id);
            $project->PlayListId = $request->PlayListId ?? $project->PlayListId;
            $project->Season = $request->Season ?? $project->Season;
            $project->ProjectNote = $request->ProjectNote ?? $project->ProjectNote;
            $project->ProjectDateIni = $request->ProjectDateIni ?? $project->ProjectDateIni;
            $project->ProjectDateEnd = $request->ProjectDateEnd ?? $project->ProjectDateEnd;
            $project->ProjectRevision = $request->ProjectRevision ?? $project->ProjectRevision;
            $project->save();

            return response()->json([
                "message" => "update success"
            ]);
        } else {
            return response()->json([
                "message" => "update failed"
            ], 404);
        }
    }

    public function destroy($id)
    {
        if (Projects::where('id', $id)->exists()) {
            $project = Projects::find($id);
            $project->delete();

            return response()->json([
                "message" => "records deleted"
            ]);
        } else {
            return response()->json([
                "message" => "delete failed"
            ]);
        }
    }
}
