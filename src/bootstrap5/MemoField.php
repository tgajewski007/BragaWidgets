<?php
namespace braga\widgets\bootstrap5;
use braga\tools\html\BaseTags;

/**
 * Created on 08-04-2011 11:42:29
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class MemoField extends \braga\widgets\base\MemoField
{
	use ClassFactory;
	use AddLabels;
	use AddValidationMessage;
	// -------------------------------------------------------------------------
	protected $maxLength = 65535;
	// -------------------------------------------------------------------------
	public function setMaxLength($maxLength)
	{
		$this->maxLength = $maxLength;
	}
	// -------------------------------------------------------------------------
	protected function updateClassString()
	{
		$this->classString .= " " . $this->getBaseClass();
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$class = "form-group";
		$this->updateClassString();

		if($this->required)
		{
			$this->onKeyUp .= "checkIsNull(this);";
			$this->onBlur .= "checkIsNull(this);";
			if($this->selected == "")
			{
				$class .= " has-error";
			}
		}
		$input = parent::out();
		$label = $this->getLabel();
		return BaseTags::div($label . $input . $this->getValidationMessage(), "class='" . $class . "'");
	}
	// -------------------------------------------------------------------------
}
?>