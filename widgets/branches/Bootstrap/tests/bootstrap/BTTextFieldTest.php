<?php
use braga\widgets\bootstrap\TextField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 17:38:10
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class BTTextFieldTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new TextField();
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='text' class='form-control'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new TextField();
		$f->setName("StrageName");
		$retval = $f->out();

		$oczekiwane = BaseTags::input("type='text' id='StrageName' name='StrageName' class='form-control'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testWartemark()
	{
		$f = new TextField();
		$f->setWatermark("StrangeName");
		$retval = $f->out();
		$oczekiwane = BaseTags::input("placeholder='StrangeName' type='text' class='form-control'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
}
?>