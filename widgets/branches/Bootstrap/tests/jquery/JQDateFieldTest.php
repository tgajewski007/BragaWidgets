<?php
use braga\widgets\jqueryui\DateField;

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

		$expected = "<div style='width:222px'>";
		$expected .= "<input maxlength='10' onblur='CheckDate(this,false,\"\",\"\");$(this).removeClass(\"ui-state-highlight\");' onfocus='$(this).addClass(\"ui-state-highlight\");'>";
		$expected .= "<a class='hand' onclick='$(\"#\").datepicker(\"show\");' onmouseover='ToolTip(\"Kliknij aby wybrać datę\",event,this)'><span class='ui-icon ui-icon-calendar' style='float:right'></span></a>";
		$expected .= "<script type='text/javascript'>$(\"#\").watermark(\"RRRR-MM-DD\");$(\"#\").datepicker({showWeek: true, onClose: function(){CheckDate($(this),false,\"\",\"\",false)}});</script></div>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new DateField();
		$f->setName("StrangeName");

		$actual = $f->out();
		$expected = "<div style='width:222px'>";
		$expected .= "<input id='StrangeName' name='StrangeName' maxlength='10' onblur='CheckDate(this,false,\"\",\"\");$(this).removeClass(\"ui-state-highlight\");' onfocus='$(this).addClass(\"ui-state-highlight\");'>";
		$expected .= "<a class='hand' onclick='$(\"#StrangeName\").datepicker(\"show\");' onmouseover='ToolTip(\"Kliknij aby wybrać datę\",event,this)'><span class='ui-icon ui-icon-calendar' style='float:right'></span></a>";
		$expected .= "<script type='text/javascript'>$(\"#StrangeName\").watermark(\"RRRR-MM-DD\");$(\"#StrangeName\").datepicker({showWeek: true, onClose: function(){CheckDate($(this),false,\"\",\"\",false)}});</script></div>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
	function testNameWitSelected()
	{
		$f = new DateField();
		$f->setName("StrangeName");
		$f->setSelected("2012-01-02");

		$actual = $f->out();
		$expected = "<div style='width:222px'>";
		$expected .= "<input id='StrangeName' name='StrangeName' maxlength='10' value='2012-01-02' onblur='CheckDate(this,false,\"\",\"\");$(this).removeClass(\"ui-state-highlight\");' onfocus='$(this).addClass(\"ui-state-highlight\");'>";
		$expected .= "<a class='hand' onclick='$(\"#StrangeName\").datepicker(\"show\");' onmouseover='ToolTip(\"Kliknij aby wybrać datę\",event,this)'><span class='ui-icon ui-icon-calendar' style='float:right'></span></a>";
		$expected .= "<script type='text/javascript'>$(\"#StrangeName\").watermark(\"RRRR-MM-DD\");$(\"#StrangeName\").datepicker({showWeek: true, onClose: function(){CheckDate($(this),false,\"\",\"\",false)}});</script></div>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
	function testNameWitSelectedMinMaxValue()
	{
		$f = new DateField();
		$f->setName("StrangeName");
		$f->setSelected("2012-01-02");
		$f->setMaxValue("2016-01-01");
		$f->setMinValue("2010-01-01");

		$actual = $f->out();
		$expected = "<div style='width:222px'>";
		$expected .= "<input id='StrangeName' name='StrangeName' maxlength='10' value='2012-01-02' onblur='CheckDate(this,false,\"2010-01-01\",\"2016-01-01\");$(this).removeClass(\"ui-state-highlight\");' onfocus='$(this).addClass(\"ui-state-highlight\");'>";
		$expected .= "<a class='hand' onclick='$(\"#StrangeName\").datepicker(\"show\");' onmouseover='ToolTip(\"Kliknij aby wybrać datę\",event,this)'><span class='ui-icon ui-icon-calendar' style='float:right'></span></a>";
		$expected .= "<script type='text/javascript'>$(\"#StrangeName\").watermark(\"RRRR-MM-DD\");$(\"#StrangeName\").datepicker({showWeek: true,minDate: new Date(2010, 0,01), maxDate: new Date(2016, 0,01),  onClose: function(){CheckDate($(this),false,\"2010-01-01\",\"2016-01-01\",false)}});</script></div>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
}
?>