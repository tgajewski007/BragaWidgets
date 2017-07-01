<?php
use braga\widgets\jqueryui\DateField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 22:07:51
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class JQDateFieldTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new DateField();

		$actual = $f->out();

		$expected = BaseTags::input("type='text' maxlength='10' class='widget ui-widget ui-widget-content ui-corner-all widgetSizeMedium' onblur='CheckDate(this,false,\"\",\"\");' onfocus='$(this).select();'");
		$expected = BaseTags::p($expected, "style='min-height:25px;'");
		$expected .= "<script type='text/javascript'>$(\"#\").watermark(\"RRRR-MM-DD\");$(\"#\").datepicker({ onClose: function(date, req, minDate, maxDate) {CheckDate($(this),false,\"\",\"\")}});</script>";

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new DateField();
		$f->setName("StrangeName");

		$actual = $f->out();
		$expected = BaseTags::input("type='text' id='StrangeName' name='StrangeName' maxlength='10' class='widget ui-widget ui-widget-content ui-corner-all widgetSizeMedium' onblur='CheckDate(this,false,\"\",\"\");' onfocus='$(this).select();'");
		$expected = BaseTags::p($expected, "style='min-height:25px;'");
		$expected .= "<script type='text/javascript'>$(\"#StrangeName\").watermark(\"RRRR-MM-DD\");$(\"#StrangeName\").datepicker({ onClose: function(date, req, minDate, maxDate) {CheckDate($(this),false,\"\",\"\")}});</script>";

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testNameWitSelected()
	{
		$f = new DateField();
		$f->setName("StrangeName");
		$f->setSelected("2012-01-02");

		$actual = $f->out();
		$expected = BaseTags::input("type='text' id='StrangeName' name='StrangeName' maxlength='10' class='widget ui-widget ui-widget-content ui-corner-all widgetSizeMedium' value='2012-01-02' onblur='CheckDate(this,false,\"\",\"\");' onfocus='$(this).select();'");
		$expected = BaseTags::p($expected, "style='min-height:25px;'");
		$expected .= "<script type='text/javascript'>$(\"#StrangeName\").watermark(\"RRRR-MM-DD\");$(\"#StrangeName\").datepicker({ onClose: function(date, req, minDate, maxDate) {CheckDate($(this),false,\"\",\"\")}});</script>";

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testNameWitSelectedMinMaxValue()
	{
		$f = new DateField();
		$f->setName("StrangeName");
		$f->setSelected("2012-01-02");
		$f->setMaxValue("2016-01-01");
		$f->setMinValue("2010-01-03");

		$actual = $f->out();
		$expected = BaseTags::input("type='text' id='StrangeName' name='StrangeName' maxlength='10' class='widget ui-widget ui-widget-content ui-corner-all widgetSizeMedium' value='2012-01-02' onblur='CheckDate(this,false,\"2010-01-03\",\"2016-01-01\");' onfocus='$(this).select();'");
		$expected = BaseTags::p($expected, "style='min-height:25px;'");
		$expected .= "<script type='text/javascript'>$(\"#StrangeName\").watermark(\"RRRR-MM-DD\");$(\"#StrangeName\").datepicker({minDate: new Date(2010, 0,03), maxDate: new Date(2016, 0,01),  onClose: function(date, req, minDate, maxDate) {CheckDate($(this),false,\"2010-01-03\",\"2016-01-01\")}});</script>";

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
}
?>