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
    public function test_create_cmd_using_constructor()
    {
        $sh = new Sh('foo');
        $this->assertEquals('foo', $sh->_compile());
    }

    public function test_create_cmd_using_cmd()
    {
        $sh = Sh::cmd('foo');
        $this->assertEquals('foo', $sh->_compile());
    }

    public function test_create_null_cmd()
    {
        $sh = new Sh;
        $this->assertEquals('', $sh->_compile());
    }

    public function test_build_cmd_using_getter()
    {
        $sh = new Sh;
        $sh->foo;

        $this->assertEquals('foo', $sh->_compile());
    }

    public function test_build_cmd_using_multiple_getters()
    {
        $sh = new Sh;
        $sh->foo;

        $this->assertEquals('foo', $sh->_compile());
    }

}
