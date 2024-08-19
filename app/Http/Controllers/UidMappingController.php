<?php

namespace App\Http\Controllers;

use App\Models\UidMapping;
use Illuminate\Http\Request;

class UidMappingController extends Controller
{
    public function index()
    {
        $mappings = UidMapping::all();
        return view('uid_mappings.index', compact('mappings'));
    }

    public function create()
    {
        return view('uid_mappings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'old_uid' => 'required',
            'new_uid' => 'required|unique:uid_mappings',
            'counter' => 'required|integer',
        ]);

        UidMapping::create($request->all());

        return redirect()->route('uid-mappings.index')->with('success', 'UID Mapping created successfully.');
    }

    public function edit(UidMapping $uidMapping)
    {
        return view('uid_mappings.edit', compact('uidMapping'));
    }

    public function update(Request $request, UidMapping $uidMapping)
    {
        $request->validate([
            'old_uid' => 'required',
            'new_uid' => 'required|unique:uid_mappings,new_uid,' . $uidMapping->id,
            'counter' => 'required|integer',
        ]);

        $uidMapping->update($request->all());

        return redirect()->route('uid-mappings.index')->with('success', 'UID Mapping updated successfully.');
    }

    public function destroy(UidMapping $uidMapping)
    {
        $uidMapping->delete();
        return redirect()->route('uid-mappings.index')->with('success', 'UID Mapping deleted successfully.');
    }
}
