<?php
use braga\widgets\jqueryui\FloatField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 17:29:42
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class JQFloatFieldTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new FloatField();

		$retval = $f->out();
		$oczekiwane = BaseTags::p(BaseTags::input("type='text' class='widget ui-widget ui-widget-content ui-corner-all r widgetSizeMedium' maxlength='22' onblur='CzyReal(this,null,null,2);' onfocus='$(this).select();'"), "style='min-height:25px;'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new FloatField();
		$f->setName("StrageName");
		$retval = $f->out();
		$oczekiwane = BaseTags::p(BaseTags::input("type='text' id='StrageName' name='StrageName' class='widget ui-widget ui-widget-content ui-corner-all r widgetSizeMedium' maxlength='22' onblur='CzyReal(this,null,null,2);' onfocus='$(this).select();'"), "style='min-height:25px;'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testValue()
	{
		$f = new FloatField();
		$f->setSelected("1234.45");
		$retval = $f->out();
		$oczekiwane = BaseTags::p(BaseTags::input("type='text' class='widget ui-widget ui-widget-content ui-corner-all r widgetSizeMedium' value='1234.45' maxlength='22' onblur='CzyReal(this,null,null,2);' onfocus='$(this).select();'"), "style='min-height:25px;'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
}
?>