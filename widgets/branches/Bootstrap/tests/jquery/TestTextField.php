<?php
use braga\widgets\jqueryui\TextField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 14:05:37
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class TestTextField extends TestC
{
	// -------------------------------------------------------------------------
	function testSimpleTestField()
	{
		$t = new TextField();
		$retval = $t->out();

		$oczekiwane = BaseTags::input("type='text' values=''");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
}
?>