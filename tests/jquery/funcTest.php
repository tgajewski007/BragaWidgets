<?php
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
		$retval = faIcon("fa-bath");
		$this->assertEquals("<i class='fa fa-bath' style='padding:2px;'></i>");
	}
	// -------------------------------------------------------------------------
}