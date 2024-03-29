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
	use AddValidationMessage;
	// -------------------------------------------------------------------------
	protected $requiredText = "-=Wybierz=-";
	// -------------------------------------------------------------------------
	protected function setDefault()
	{
		$this->setClassString("form-control show-tick");
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$class = "form-group";
		$this->setDefault();
		if(empty($this->selected))
		{
			$this->addAttrib("title", $this->requiredText);
		}
		if($this->required)
		{
			$this->addAttrib("required", "true");
			if(empty($this->selected))
			{
				$class .= " has-error";
			}
		}
		$input = parent::out();
		$label = $this->getLabel();

		$script = BaseTags::script("initDropDownList(\$(\"#" . $this->id . "\"));");
		return BaseTags::div($label . $input . $this->getValidationMessage(), "class='" . $class . "'") . $script;
	}
	// -------------------------------------------------------------------------
}
?>