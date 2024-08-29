<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NfcTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Session::put('user', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('scan-code.create');
    }

    public function scan_code()
    {
        $data['url'] = route('login.store');
        return view('scan-code.create', $data);
    }


    public function login()
    {
        // generate 4-digit random but unique uid
        do {
            $uid = random_int(1000, 9999);
        } while (NfcTag::where('uid', $uid)->exists());

        
        // store user detail in database
        $user = User::create([
            'name' => Session::get('user.name'),
            'email' => Session::get('user.email'),
            'password' => Hash::make(Session::get('user.password')),
        ]);

        // store NFC Tag
        $nfcTag = NfcTag::create([
            'uid' => $uid,
            'user_id' => $user->id,
            'counter' => 1,
        ]);

        // login user
        Auth::login($user);
        return redirect()->route('content');
    }

    public function content()
    {
        return view('content');
    }
}
