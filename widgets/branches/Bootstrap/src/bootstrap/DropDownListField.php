<?php

namespace braga\widgets\bootstrap;

use braga\tools\html\BaseTags;

/**
 * Created on 10-06-2011 10:45:23
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class DropDownListField extends \braga\widgets\base\DropDownListField
{
	use ClassFactory;
	use AddLabels;
	// -------------------------------------------------------------------------
	protected $requiredText = "-=Wybierz=-";
	// -------------------------------------------------------------------------
	protected function setDefault()
	{
		$this->setClassString($this->getBaseClass());
		$this->setOnChange("checkDropDownList(this);");
	}
	// -------------------------------------------------------------------------
	// protected function getGroupOptions()
	// {
	// $options = "";
	// if($this->required)
	// {
	// $this->setClassString($this->getBaseClass() . " combo ui-state-error");
	// $tmp = BaseTags::option($this->requiredText, "value='' class='ui-state-default ui-state-error' selected='selected'");
	// $options .= BaseTags::optgroup($tmp, "label='" . $this->requiredText . "' class='ui-priority-primary widget ui-widget-content ui-state-error'");
	// }
	// $tmp = $this->prepareGroup();
	// foreach($tmp as $key => $value)
	// {
	// $opt = "";
	// foreach($value as $d)/* @var $d WidgetItem */
	// {
	// $opt .= $this->getOption($d->getDesc(), $d->getVal());
	// }
	// $options .= $this->getOptionGroup($key, $opt);
	// }
	// return $options; // kasia kocha tomka :))
	// }
	// // -------------------------------------------------------------------------
	// protected function getSimpleOptions()
	// {
	// $options = "";
	// if($this->required)
	// {
	// $this->setClassString($this->getBaseClass() . " combo ui-state-error");
	// $options .= BaseTags::option($this->requiredText, "value='' class='ui-state-default ui-state-error' selected='selected'");
	// }
	// $options .= parent::getSimpleOptions();
	// return $options;
	// }
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->setDefault();
		$input = parent::out();
		$label = $this->getLabel();
		if($this->required && empty($this->selected))
		{
			return BaseTags::div($label . $input, "class='form-group has-error'");
		}
		else
		{
			return BaseTags::div($label . $input, "class='form-group'");
		}
	}
	// -------------------------------------------------------------------------
}
?>