<?php

namespace App\Http\Controllers;

use App\Driver\Drivers\WireguardDriver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    protected $vpnDriver;

    public function __construct()
    {
        $this->vpnDriver = new WireguardDriver();
    }

    public function index(){
        if(Auth::guest()) {
            return view('login/login');
        }else{
            $clients = $this->vpnDriver->listClients();
            $profiles = $this->vpnDriver->listProfiles();
            return view('dashboard/dashboard', ['clients'=> $clients, 'profiles' =>$profiles]);
        }
    }
}
