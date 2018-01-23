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
class TextField extends \braga\widgets\base\TextField
{

	use ClassFactory;
	use AddLabels;
	use AddValidationMessage;
	// -----------------------------------------------------------------------------------------------------------------
	protected $waterMark;
	protected $regExPatern = null;
	protected $minLength;
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * @return mixed
	 */
	public function getMinLength()
	{
		return $this->minLength;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 *
	 * @param mixed $minLength
	 */
	public function setMinLength($minLength)
	{
		$this->minLength = $minLength;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function setRegExpPatern($patern)
	{
		$this->regExPatern = $patern;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function setWatermark($w)
	{
		$this->waterMark = $w;
	}
	// -----------------------------------------------------------------------------------------------------------------
	protected function setDefault()
	{
		$this->setClassString($this->getBaseClass());
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function out()
	{
		$class = "form-group";
		$this->setDefault();
		$this->addAttrib("placeholder", $this->waterMark);
		$this->addAttrib("data-minlength", $this->getMinLength());
		$this->addAttrib("data-error", $this->getMessageWhenValidateFail());

		if($this->required)
		{
			if($this->selected == "")
			{
				$class .= " has-error";
			}
		}
		$input = parent::out();
		$label = $this->getLabel();

		return BaseTags::div($label . $input . $this->getValidationMessage(), "class='" . $class . "'");
	}
	// -----------------------------------------------------------------------------------------------------------------
}