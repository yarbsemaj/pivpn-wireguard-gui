<?php


namespace App\Driver\Drivers;


use App\Driver\ConsoleOutput;
use App\Driver\VPNDriver;
use App\Models\VPNClient;
use App\Models\VPNProfile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class WiregaurdDriver implements VPNDriver
{
    protected $config;

    public function __construct()
    {
        $this->parseConfig(File::get("/etc/pivpn/wireguard/setupVars.conf"));
    }

    function addProfile(string $name, int $expires = 0): ConsoleOutput
    {
        $name = escapeshellarg($name);
        $output = shell_exec("pivpn add --name $name");
        $message = null;
        if(strpos($output, 'already exists')){
            $message = "Client already exists";
        }
        return new ConsoleOutput((strpos($output, 'Done!') !== false) ,$output, $message);
    }

    function revokeProfile(VPNProfile $profile): ConsoleOutput
    {
        $name = escapeshellarg($profile->name);
        $output = shell_exec("pivpn remove $name --yes");
        return new ConsoleOutput((strpos($output, 'WireGuard reloaded') !== false) ,$output);
    }

    function listClients(): Collection
    {
        $returnData = collect();
        $clientStats = shell_exec("pivpn clients");
        $clientStats = $this->stripHeaderLines($clientStats);
        $lines = explode("\n",$clientStats);
        foreach ($lines as $line) {
            $data = preg_split('/\s+/', $line, 6);
            if(count($data) == 6) {
                $returnData->add(new VPNClient([
                    'name' => $data[0],
                    'external_IP' => $data[1],
                    'internal_IP' => $data[2],
                    'upload' => $data[3],
                    'download' => $data[4],
                    'last_connected' => $data[5],
                ]));
            }
        }
        return $returnData;
    }

    function listProfiles(): Collection
    {
        $returnData = collect();
        $prodileStats = shell_exec("pivpn list");
        $prodileStats = $this->stripHeaderLines($prodileStats);
        $lines = explode("\n",$prodileStats);
        foreach ($lines as $line) {
            $data = preg_split('/\s+/', $line, 3);
            if(count($data) == 3) {
                $returnData->add(new VPNProfile([
                    'name' => $data[0],
                    'public_key' => $data[1],
                    'created_date' => $data[2]
                ]));
            }
        }
        return $returnData;
    }

    /**
     * Parse the wiregaurd config
     * @param $configString string
     */
    private function parseConfig($configString){
        $lines = explode("\n", $configString);
        foreach ($lines as $line){
            $parsedLines = explode('=', $line);
            if(count($parsedLines) ==2) {
                $this->config[$parsedLines[0]] = $parsedLines[1];
            }
        }
    }

    private function stripHeaderLines($file){
        $lines = explode("\n", $file);
        $exclude = array();
        foreach ($lines as $line) {
            if (strpos($line, '[') !== FALSE) {
                continue;
            }
            $exclude[] = $line;
        }
        return implode("\n", $exclude);
    }

    function getRawProfile(VPNProfile $profile): string
    {
       $file= escapeshellarg("{$this->config['install_home']}/configs/{$profile->name}.conf");
       return shell_exec("sudo cat $file");
    }
}
