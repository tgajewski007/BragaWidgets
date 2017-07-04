<?php
namespace braga\widgets\bootstrap;
use braga\widgets\base\Field;
use braga\tools\html\BaseTags;
use braga\widgets\base\WidgetItem;
use braga\widgets\base\CheckBoxField;

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
			$a = new CheckBoxField();
			$a->setName($this->name . "[]");
			$a->setId($this->id . "_" . $value->getVal());
			$a->setSelected(isset($this->selected[$value->getVal()]));
			$a->setValue($value->getVal());
			$retval .= BaseTags::div(BaseTags::label($a->out() . $value->getDesc(), "class='checkbox-block'"), "class='checkbox'");
		}
		$label = $this->getLabel();
		return BaseTags::div($label . $retval, "class='form-group'");
	}
	// -------------------------------------------------------------------------
}
?>