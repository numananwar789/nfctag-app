<?php

namespace App\Http\Controllers;

use App\Models\NfcTag;
use App\Models\User;
use Illuminate\Http\Request;

class NfcTagController extends Controller
{
    public function index()
    {
        $tags = NfcTag::all();
        return view('nfc_tags.index', compact('tags'));
    }

    public function create()
    {
        // Retrieve all users except the one with the email 'admin@example.com'
        $users = User::where('email', '!=', 'admin@admin.com')->get();

        // Pass the $users variable to the view
        return view('nfc_tags.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uid' => 'required|unique:nfc_tags',
            'user_id' => 'required|exists:users,id',
        ]);

        NfcTag::create($request->all());

        return redirect()->route('nfc-tags.index')->with('success', 'NFC Tag created successfully.');
    }

    public function edit(NfcTag $nfcTag)
    {
        // Retrieve all users except the one with the email 'admin@example.com'
        $users = User::where('email', '!=', 'admin@admin.com')->get();

        return view('nfc_tags.edit', compact('nfcTag', 'users'));
    }

    public function update(Request $request, NfcTag $nfcTag)
    {
        $request->validate([
            'uid' => 'required|unique:nfc_tags,uid,' . $nfcTag->id,
            'user_id' => 'required|exists:users,id',
        ]);

        $nfcTag->update($request->all());

        return redirect()->route('nfc-tags.index')->with('success', 'NFC Tag updated successfully.');
    }

    public function destroy(NfcTag $nfcTag)
    {
        $nfcTag->delete();
        return redirect()->route('nfc-tags.index')->with('success', 'NFC Tag deleted successfully.');
    }
}
