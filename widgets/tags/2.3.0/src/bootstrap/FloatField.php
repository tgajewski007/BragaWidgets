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
	// -------------------------------------------------------------------------
	protected function setDefault()
	{
		$this->setClassString($this->getBaseClass());
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$class = "form-group";
		$this->setDefault();
		$this->addAttrib("placeholder", $this->waterMark);

		if($this->required)
		{
			$this->onBlur .= "if(checkReal(this," . $this->minValue . "," . $this->maxValue . "," . $this->precision . ")){checkIsNull(this);}";
			if($this->selected == "")
			{
				$class .= " has-error";
			}
		}
		else
		{
			$this->onBlur .= "checkReal(this," . $this->minValue . "," . $this->maxValue . "," . $this->precision . ");";
		}

		$input = parent::out();
		$label = $this->getLabel();
		return BaseTags::div($label . $input . $this->getValidationMessage(), "class='" . $class . "'");
	}
	// -------------------------------------------------------------------------
}