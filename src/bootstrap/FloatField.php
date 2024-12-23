<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 17:37:05
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class FloatField extends \braga\widgets\base\FloatField
{
	use ClassFactory;
	use AddLabels;
	use AddValidationMessage;
	// -------------------------------------------------------------------------
	protected $waterMark;
	// -------------------------------------------------------------------------
	public function setWatermark($w)
	{
		$this->waterMark = $w;
	}
	// ------------------------------------------------------------------------
	protected function updateClassString()
	{
		$this->classString .= " " . $this->getBaseClass();
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$class = "form-group";
		$this->updateClassString();
		$this->addAttrib("placeholder", $this->waterMark);
		$this->addAttrib("data-error", $this->getMessageWhenValidateFail());
		$pattern = $this->precision > 0
			? "-?\d+(\.\d{1,{$this->precision}})?"
			: "-?\d+";
		$this->addAttrib("pattern", $pattern);
		$this->setOnKeyUp("\$(this).val(\$(this).val().replace(\",\",\".\"));" . $this->onKeyUp);
		if($this->required)
		{
			if($this->selected == "")
			{
				$class .= " has-error";
			}
		}
		$this->addCustomAttrib();

		$input = parent::out();
		$label = $this->getLabel();
		return BaseTags::div($label . $input . $this->getValidationMessage(), "class='" . $class . "'");
	}
	// -------------------------------------------------------------------------
}