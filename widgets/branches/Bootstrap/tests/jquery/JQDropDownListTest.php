<?php
use braga\widgets\jqueryui\WidgetItem;
use braga\widgets\jqueryui\DropDownListField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 18:31:37
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class JQDropDownListTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new DropDownListField();
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected = BaseTags::select($expected, "class='combo' onchange='SprawdzCombo(this);'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new DropDownListField();
		$f->setName("StrangeName");
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected = BaseTags::select($expected, "id='StrangeName' name='StrangeName' class='combo' onchange='SprawdzCombo(this);'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testTreeValue()
	{
		$f = new DropDownListField();
		$f->setName("StrangeName");
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected .= BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected .= BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected = BaseTags::select($expected, "id='StrangeName' name='StrangeName' class='combo' onchange='SprawdzCombo(this);'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testGroup()
	{
		$f = new DropDownListField();
		$f->setName("StrangeName");
		$f->enableGrouping();
		$f->addItem(new WidgetItem("StrageName", "StrangeValue", "StrageGroup"));
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected = BaseTags::optgroup($expected, "label='StrageGroup' class='ui-priority-primary widget ui-widget-content ui-corner-all'");
		$expected = BaseTags::select($expected, "id='StrangeName' name='StrangeName' class='combo' onchange='SprawdzCombo(this);'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
}
?>