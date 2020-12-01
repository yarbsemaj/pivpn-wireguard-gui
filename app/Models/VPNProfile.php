<?php

namespace App\Models;


use App\Driver\Drivers\WireguardDriver;
use Jenssegers\Model\Model;

class VPNProfile extends Model
{
    private $vpnDriver;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->vpnDriver = new WireguardDriver();
    }

    public function getRawAttribute(){
        return $this->vpnDriver->getRawProfile($this);
    }
}
