<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Members::all();
        return view('tugas.tugas', compact('members'));
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
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'string|nullable',
            'hobby' => 'string|nullable',
            'major' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'bio' => 'nullable|string',
        ]);

        $profilePicturePath = null;

        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $lastName = $request->last_name ?? null;
        $hobby = $request->hobby ?? null;

        Members::create([
            'first_name' => $request->first_name,
            'last_name' => $lastName,
            'major' => $request->major,
            'profile_picture' => $profilePicturePath,
            'bio' => $request->bio,
            'hobby' => $hobby,
        ]);

        return redirect()->route('members.index')->with('success', 'Member added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
        $members = Members::all();
        $viewMember = Members::findOrFail($id);

        return view('tugas.tugas', compact('members', 'viewMember'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $members = Members::all();
        $editMember = Members::findOrFail($id);

        return view('tugas.tugas', compact('members', 'editMember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'string|nullable',
            'hobby' => 'string|nullable',
            'major' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'bio' => 'nullable|string',
        ]);

        $profilePicturePath = null;

        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $lastName = $request->last_name ?? null;
        $hobby = $request->hobby ?? null;

        Members::where('id', $id)->update([
            'first_name' => $request->first_name,
            'last_name' => $lastName,
            'major' => $request->major,
            'profile_picture' => $profilePicturePath,
            'bio' => $request->bio,
            'hobby' => $hobby,
        ]);

        return redirect()->route('members.index')->with('success', 'Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Members::where('id', $id)->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully');
    }
}
