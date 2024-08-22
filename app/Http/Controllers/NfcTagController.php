<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NfcTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class NfcTagController extends Controller
{
    public function index()
    {
        $tags = NfcTag::all();
        return view('nfc_tags.index', compact('tags'));
    }

    public function create()
    {
        $users = User::where('email', '!=', 'admin@admin.com')->get();
        return view('nfc_tags.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uid' => 'required|unique:nfc_tags',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $nfcTag = NfcTag::create([
            'uid' => $request->uid,
            'user_id' => $request->user_id,
        ]);

        

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

    public function show($id)
    {
        $data['url'] = route('nfc-tags.show', $id);
        return view('nfc_tags.show', $data);
    }

    public function destroy(NfcTag $nfcTag)
    {
        $nfcTag->delete();
        return redirect()->route('nfc-tags.index')->with('success', 'NFC Tag deleted successfully.');
    }
}
