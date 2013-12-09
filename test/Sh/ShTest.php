<?php
namespace Sh;

require_once('../src/Sh/Sh.php');

/**
 * Sh Test
 *
 * @author warmans
 */
class ShTest extends \PHPUnit_Framework_TestCase
{
    public function test_nothing()
    {
        $sh = new Sh();
        print_r($sh->ps('u'));
    }
}
