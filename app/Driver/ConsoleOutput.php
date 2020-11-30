<?php

namespace App\Driver;

use Illuminate\Contracts\Support\Jsonable;

class ConsoleOutput implements Jsonable
{
    public $consoleOutput;
    public $success;
    public $message;


    public function __construct(bool $sucsess, string $consoleOutput, string $message = null)
    {
        $this->consoleOutput = $consoleOutput;
        $this->success = $sucsess;
        $this->message = $message;
    }

    public function toJson($options = 0)
    {
        return json_encode($this);
    }
}
