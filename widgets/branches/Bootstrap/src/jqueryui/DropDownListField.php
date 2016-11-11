<?php

namespace braga\widgets\jqueryui;

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
		$this->addOptionGroupAtrib("class='ui-priority-primary'");
		$this->setClassString("combo");
		$this->setOnChange("SprawdzCombo(this);");
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