<?php
namespace braga\widgets\base;
use braga\tools\html\BaseTags;

/**
 * Created on 04.07.2017 23:03:20
 * @author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class RadioBoxField extends Field
{
	// -------------------------------------------------------------------------
	protected $type = "radio";
	protected $value = "1";
	// -------------------------------------------------------------------------
	public function setValue($value)
	{
		$this->value = $value;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->attrib = null;
		$this->addAttrib("type", $this->type);
		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("value", $this->value);
		$this->addAttrib("tabindex", $this->tabOrder);
		if($this->required)
		{
			$this->addAttrib("required", "true");
		}
		if($this->selected)
		{
			$this->addAttrib("checked", "checked");
		}
		$this->addEvents();
		$this->addCustomAttrib();
		return BaseTags::input($this->attrib);
	}
	// -------------------------------------------------------------------------
}