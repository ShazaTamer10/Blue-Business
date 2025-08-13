<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TeamDataTable;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
     public function index(TeamDataTable $dataTable)
    {
        return $dataTable->render('admin.team.index');
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
        }

        TeamMember::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $path
        ]);

        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully!');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $team->image;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('team', 'public');
        }

        $team->update([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $path
        ]);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully!');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully!');
    }
}

