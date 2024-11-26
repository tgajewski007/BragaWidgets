<?php
use braga\tools\html\BaseTags;

/**
 * Created on 18.03.2017 17:42:24
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class funcTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testIcon()
	{
		$retval = BaseTags::i("fa fa-bath");
		$this->assertEquals($retval, BaseTags::i("", "class='fa fa-bath'"));
	}
	// -------------------------------------------------------------------------
}