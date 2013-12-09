<?php
namespace Sh;

/**
 * Result
 *
 * @author warmans
 */
class Result
{
    private $cmd;
    private $status;
    private $stdout;
    private $stderr;

    public function __construct($cmd, $status, $stdout, $stderr)
    {
        $this->cmd = $cmd;
        $this->status = $status;
        $this->stdout = $stdout;
        $this->stderr = $stderr;
    }

    public function getStdout()
    {
        return $this->stdout;
    }

    public function getStderr()
    {
        return $this->stderr;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function verify(array $allowed_status=array(0)){
        if(!in_array($this->status, $allowed_status))
        {
            throw new \RuntimeException(
                "Command '$this->cmd' failed with status $this->status. ERR: $this->stderr, OUT: $this->stdout"
            );
        }
    }
}
