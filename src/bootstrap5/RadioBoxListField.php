<?php
namespace braga\widgets\bootstrap5;
use braga\widgets\base\Field;
use braga\widgets\base\WidgetItem;
use braga\tools\html\BaseTags;

/**
 * Created on 04.07.2017 23:05:56
 * @author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class RadioBoxListField extends Field
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
			$a = new RadioBoxField();
			$a->setName($this->name);
			$a->setId($this->id . "_" . $value->getVal());
			$a->setSelected($this->selected == $value->getVal());
			$a->setValue($value->getVal());
			$a->setLabel($value->getDesc());
			if(empty($this->selected) && $this->required)
			{
				$a->setRequired();
			}
			$retval .= $a->out();
		}
		$label = $this->getLabel();
		return BaseTags::div($label . $retval, "class='form-group'");
	}
	// -------------------------------------------------------------------------
}