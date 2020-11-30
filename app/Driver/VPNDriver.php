<?php


namespace App\Driver;


use App\Models\VPNProfile;
use Illuminate\Support\Collection;

interface VPNDriver
{
    /**
     * Adds a vpn profile
     * @param string $name profile name
     * @param int $expires profile expiry time. 0 is no expiry time.
     * @return ConsoleOutput newly created profile and console output.
     */
    function addProfile(string $name, int $expires = 0): ConsoleOutput;

    /**
     * Revoke a vpn profile
     * @param VPNProfile $profile vpn profile to revoke
     * @return ConsoleOutput Console output
     */
    function revokeProfile(VPNProfile $profile) : ConsoleOutput;

    /**
     * List of current vpn clients
     * @return Collection of VPNClients
     */
    function listClients() : Collection;

    /**
     * List of current vpn profiles
     * @return Collection
     */
    function listProfiles() : Collection;

    /**
     * Get the a raw VPN profile from disk.
     * @param VPNProfile $profile
     * @return string ptofile contents
     */
    function getRawProfile(VPNProfile $profile): string;
}
