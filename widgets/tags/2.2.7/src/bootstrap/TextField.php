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
	// -------------------------------------------------------------------------
	protected $waterMark;
	protected $regExPatern = null;
	// -------------------------------------------------------------------------
	public function setRegExpPatern($patern)
	{
		$this->regExPatern = $patern;
	}
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
			$this->onKeyUp .= "checkIsNull(this);";
			$this->onBlur .= "checkIsNull(this);";
			if($this->selected == "")
			{
				$class .= " has-error";
			}
		}
		if(!is_null($this->regExPatern))
		{
			$checkScript = "if(!checkRegExPatern(this," . $this->regExPatern . ")){return false};";
			$this->onChange .= $checkScript;
			$this->onBlur .= $checkScript;
			$this->onKeyUp .= $checkScript;
		}
		$input = parent::out();
		$label = $this->getLabel();
		return BaseTags::div($label . $input, "class='" . $class . "'");

		// -------------------------------------------------------------------------
	}
}