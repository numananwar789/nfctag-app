<?php

namespace App\Http\Controllers;

use App\Models\NfcTag;
use App\Models\NfcAccessLog;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function validateNFC(Request $request)
    {
        $uid = $request->query('uid');
        $counter = (int) $request->query('counter');

        // Fetch the corresponding NFC tag
        $nfcTag = NfcTag::where('uid', $uid)->first();

        if (!$nfcTag) {
            return view('errors.access_denied', ['message' => 'Invalid UID']);
        }

        // Validate counter
        if ($counter < $nfcTag->counter) {
            return view('errors.access_denied', ['message' => 'Invalid counter']);
        }

        // Increment counter and log the access
        $nfcTag->increment('counter');
        NfcAccessLog::create([
            'uid' => $uid,
            'counter' => $counter,
            'ip_address' => $request->ip(),
            'status' => 'success'
        ]);

        // Grant access
        return view('content', ['uid' => $uid]);
    }

    
}
