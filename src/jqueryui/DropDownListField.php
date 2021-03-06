<?php
namespace braga\widgets\jqueryui;
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
	// -------------------------------------------------------------------------
	protected $requiredText = "-=Wybierz=-";
	// -------------------------------------------------------------------------
	protected function setDefault()
	{
		$this->addOptionAtrib("class='ui-state-default'");
		$this->addOptionGroupAtrib("class='ui-priority-primary widget ui-widget-content'");
		$this->setClassString($this->getBaseClass() . " combo");
		$this->setOnChange("if(checkCombo(this)){" . $this->onChange . "} else {return false;}");
	}
	// -------------------------------------------------------------------------
	protected function getGroupOptions()
	{
		$options = "";
		if($this->required)
		{
			if(empty($this->selected))
			{
				$this->setClassString($this->getBaseClass() . " combo ui-state-error");
			}
			$tmp = BaseTags::option($this->requiredText, "value='' class='ui-state-default ui-state-error' selected='" . (empty($this->selected) ? "selected" : "") . "'");
			$options .= BaseTags::optgroup($tmp, "label='" . $this->requiredText . "' class='ui-priority-primary widget ui-widget-content ui-state-error'");
		}
		$tmp = $this->prepareGroup();
		foreach($tmp as $key => $value)
		{
			$opt = "";
			foreach($value as $d)/* @var $d WidgetItem */
			{
				$opt .= $this->getOption($d);
			}
			$options .= $this->getOptionGroup($key, $opt);
		}
		return $options; // kasia kocha tomka :))
	}
	// -------------------------------------------------------------------------
	protected function getSimpleOptions()
	{
		$options = "";
		$options .= BaseTags::option($this->requiredText, "value='' class='ui-state-default " . ($this->required ? "ui-state-error" : "") . "' selected='" . (empty($this->selected) ? "selected" : "") . "'");
		if($this->required && empty($this->selected))
		{
			$this->setClassString($this->getBaseClass() . " combo ui-state-error");
		}
		$options .= parent::getSimpleOptions();
		return $options;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->setDefault();

		return parent::out();
	}
	// -------------------------------------------------------------------------
}
?>