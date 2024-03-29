<?php
namespace braga\widgets\bootstrap5;
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
		foreach($this->dane as $value)/* @var $value WidgetItem */
		{

			$retval .= BS::checkbox2($value->getDesc(), $this->name . "[]", isset($this->selected[$value->getVal()]), $value->getVal());

			// $a = new CheckBoxField();
			// $a->setName($this->name . "[]");
			// $a->setId($this->id . "_" . $value->getVal());
			// $a->setSelected();
			// $a->setValue($value->getVal());
			// $a->setLabel($value->getDesc());
			// $retval .= $a->out();
		}
		$label = $this->getLabel();
		return BaseTags::div($label . $retval, "class='form-group'");
	}
	// -------------------------------------------------------------------------
}
?>