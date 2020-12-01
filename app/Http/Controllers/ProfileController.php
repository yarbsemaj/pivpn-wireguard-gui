<?php

namespace App\Http\Controllers;

use App\Driver\Drivers\WireguardDriver;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $vpnDriver;

    public function __construct()
    {
        $this->vpnDriver = new WireguardDriver();
    }

    public function get($name){
        $profile = $this->vpnDriver->listProfiles()->firstWhere('name', $name);
        if(!$profile){
            abort(404);
        }
        return view('profile.profile',['profile'=>$profile]);
    }

    public function post(Request $request){
        $profile = $this->vpnDriver->addProfile($request->input('name'));
        return response($profile, $profile->success ? 200 : 409);
    }

    public function delete(Request $request, $name){
        $profile = $this->vpnDriver->listProfiles()->firstWhere('name', $name);
        if(!$profile){
            abort(404);
        }
        $profile = $this->vpnDriver->revokeProfile($profile);
        return response($profile, $profile->success ? 200 : 500);
    }

    public function download($name){
        $profile = $this->vpnDriver->listProfiles()->firstWhere('name', $name);
        if(!$profile){
            abort(404);
        }
        return response($profile->raw)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', "$profile->name.conf")
            ->header('Content-length', strlen($profile->raw));
    }
}
