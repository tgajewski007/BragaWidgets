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
		$input = parent::out();
		$label = $this->getLabel();

		if($this->required)
		{
			$this->onKeyUp .= "checkIsNull(this);";
			$this->onBlur .= "checkIsNull(this);";
			if($this->selected == "")
			{
				$class .= " has-error";
			}
		}
		return BaseTags::div($label . $input, "class='" . $class . "'");

		// -------------------------------------------------------------------------
	}
}