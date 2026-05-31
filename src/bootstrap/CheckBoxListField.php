<?php
namespace braga\widgets\bootstrap;
use braga\widgets\base\Field;
use braga\tools\html\BaseTags;
use braga\widgets\base\WidgetItem;

/**
 * Created on 11.11.2016 21:00:51
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class CheckBoxListField extends Field
{
	use AddLabels;
	// -------------------------------------------------------------------------
	/**
	 * @var WidgetItem[]
	 */
	protected $dane = array();
	// -------------------------------------------------------------------------
	public function addItem(WidgetItem $item)
	{
		$this->dane[] = $item;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$retval = "";
		foreach($this->dane as $value)
		{
			$retval .= BS::checkbox2($value->getDesc(), $this->name . "[]", isset($this->selected[$value->getVal()]), $value->getVal());
		}
		$label = $this->getLabel();
		return BaseTags::div($label . $retval, "class='form-group'");
	}
	// -------------------------------------------------------------------------
}
?>