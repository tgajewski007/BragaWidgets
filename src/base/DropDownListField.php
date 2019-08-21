<?php
namespace braga\widgets\base;
use braga\tools\html\BaseTags;

/**
 * Created on 10-06-2011 10:45:23
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class DropDownListField extends Field
{
	// -------------------------------------------------------------------------
	protected $dane = array();
	protected $group = false;
	protected $requiredText = "-=Wybierz=-";
	// -------------------------------------------------------------------------
	protected $commonOptionAtrib = null;
	protected $optionGroupAtrib = null;

	// -------------------------------------------------------------------------
	public function addOptionAtrib($atr)
	{
		$this->commonOptionAtrib = trim($this->commonOptionAtrib . " " . trim($atr));
	}
	// -------------------------------------------------------------------------
	public function addOptionGroupAtrib($atr)
	{
		$this->optionGroupAtrib = trim($this->optionGroupAtrib . " " . trim($atr));
	}
	// -------------------------------------------------------------------------
	public function addItem(WidgetItem $item)
	{
		$this->dane[] = $item;
	}
	// -------------------------------------------------------------------------
	public function enableGrouping()
	{
		$this->group = true;
	}
	// -------------------------------------------------------------------------
	protected function getOption(WidgetItem $w)
	{
		if($this->selected === $w->getVal())
		{
			return BaseTags::option($w->getDesc(), "value='" . $w->getVal() . "' " . $w->getCustomAttrib() . " " . $this->commonOptionAtrib . " selected='selected'");
		}
		else
		{
			return BaseTags::option($w->getDesc(), "value='" . $w->getVal() . "' " . $w->getCustomAttrib() . " " . $this->commonOptionAtrib);
		}
	}
	// -------------------------------------------------------------------------
	protected function getOptionGroup($label, $options)
	{
		return BaseTags::optgroup($options, "label='" . $label . "' " . $this->optionGroupAtrib);
	}
	// -------------------------------------------------------------------------
	protected function prepareGroup()
	{
		$tmp = array();
		foreach($this->dane as $d ) /* @var $d WidgetItem */
		{
			$tmp[$d->getGroupDesc()][] = $d;
		}
		return $tmp;
	}
	// -------------------------------------------------------------------------
	protected function getGroupOptions()
	{
		$options = "";
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
		return $options;
	}
	// -------------------------------------------------------------------------
	protected function getSimpleOptions()
	{
		$options = "";
		foreach($this->dane as $d ) /* @var $d WidgetItem */
		{
			$options .= $this->getOption($d);
		}
		return $options;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		if($this->group)
		{
			$options = $this->getGroupOptions();
		}
		else
		{
			$options = $this->getSimpleOptions();
		}

		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addEvents();
		$this->addCustomAttrib();
		return BaseTags::select($options, $this->attrib);
	}
	// -------------------------------------------------------------------------
}
?>