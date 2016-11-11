<?php

namespace braga\widgets\jqueryui;

use braga\tools\html\BaseTags;

/**
 * Created on 08-04-2011 11:42:29
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class TextField extends \braga\widgets\base\TextField
{
	use ClassFactory;
	// -------------------------------------------------------------------------
	protected $class = null;
	// -------------------------------------------------------------------------
	protected function setDefaults()
	{
		$this->class .= $this->getBaseClass();
		$this->class .= " " . $this->getMediumSizeClass();
		$this->onFocus .= "\$(this).select();";
		if(empty($this->maxLength))
		{
			$this->setMaxLength(255);
		}
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->setDefaults();

		if(!$this->readOnly)
		{
			$this->onFocus .= "\$(this).addClass(\"widgetHighLight a ui-state-highlight\");";
			$this->onBlur .= "\$(this).removeClass(\"widgetHighLight a ui-state-highlight\");";
		}
		if($this->required)
		{
			$this->onKeyUp = "CzyNull(this);" . $this->onKeyUp;
			if($this->selected == "")
			{
				$this->classString .= " " . $this->getErrorClass();
			}
		}
		if(!is_null($this->regExPatern))
		{
			$checkScript .= "if(!checkRegExPatern(this,\"" . $this->regExPatern . "\")){return false};";
		}

		$this->onChange = $this->onChange . $checkScript;
		$this->onBlur = $this->onBlur . $checkScript;
		$this->onKeyUp = $this->onKeyUp . $checkScript;
		$this->setClassString($this->class);
		return BaseTags::p(parent::out(), "style='min-height:25px;'");
	}
	// -------------------------------------------------------------------------
}
?>