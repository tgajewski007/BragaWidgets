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
	// -------------------------------------------------------------------------
	protected $label;
	protected $waterMark;
	// -------------------------------------------------------------------------
	public function setLabel($label)
	{
		$this->label = $label;
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
		$this->setDefault();
		$this->addAttrib("placeholder", $this->waterMark);
		$input = parent::out();
		$label = "";
		if(!empty($this->label))
		{
			$label = BaseTags::label($this->label, "for='" . $this->name . "'");

		}
		return BaseTags::div($label . $input, "class='form-group'");
		// -------------------------------------------------------------------------
	}
}