<?php

namespace App\Http\Controllers;

use App\Models\NfcAccessLog;

class NfcAccessLogController extends Controller
{
    public function index()
    {
        $logs = NfcAccessLog::latest()->paginate(5);
        return view('nfc_access_logs.index', compact('logs'));
    }

    public function destroy(NfcAccessLog $log)
    {
        $log->delete();
        return redirect()->route('nfc-access-logs.index')->with('success', 'Log deleted successfully.');
    }
}
