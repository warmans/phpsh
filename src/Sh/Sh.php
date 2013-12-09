<?php
namespace Sh;

require_once('Result.php');

class Sh
{
    private $cmd = array();
    private $args = array();

    public static function cmd($name=null)
    {
        return new static($name);
    }

    public function __construct($cmd=null)
    {
        if ($cmd) {
            $this->cmd[] = $cmd;
        }
    }

    public function __call($name, $arguments)
    {
        $this->cmd[] = $name;
        $this->args = $arguments;

        return $this->_execute($this->_compile());
    }

    public function __get($name)
    {
        $this->cmd[] = $name;
        return $this;
    }

    public function _compile()
    {
        return implode(' ', $this->cmd). ' '.implode(' ', $this->args); //todo quote args?
    }

    public function _execute($cmd)
    {
        //request in, out, err
        $descriptorspec = array(
            0 => array("pipe", "r"),  // stdin
            1 => array("pipe", "w"),  // stdout
            2 => array("pipe", "w"),  // stderr
        );

        //create the process
        $process = proc_open($cmd, $descriptorspec, $pipes);

        //read stdout
        $stdout = trim(stream_get_contents($pipes[1]));
        fclose($pipes[1]);

        //read stderr
        $stderr = trim(stream_get_contents($pipes[2]));
        fclose($pipes[2]);

        //return a response
        return new Result($cmd, proc_close($process), $stdout, $stderr);
    }
}

