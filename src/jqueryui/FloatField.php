<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;
use braga\widgets\base\FloatField;

/**
 * Created on 17-05-2011 07:55:40
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class FloatField extends FloatField
{
	use ClassFactory;
	// -------------------------------------------------------------------------
	protected $class = null;
	// -------------------------------------------------------------------------
	protected function setDefaults()
	{
		$this->class .= $this->getBaseClass();
		$this->class .= " r " . $this->getMediumSizeClass();
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
		$checkScript = "";
		if($this->required)
		{
			$checkScript .= "if(CzyReal(this," . $this->minValue . "," . $this->maxValue . "," . $this->precision . ")){CzyNull(this);}";
			if("" == $this->selected)
			{
				$this->class .= " " . $this->getErrorClass();
			}
		}
		else
		{
			$checkScript .= "CzyReal(this," . $this->minValue . "," . $this->maxValue . "," . $this->precision . ");";
		}

		if(null != $this->selected)
		{
			// sprawdzenie czy poza max / min
			if($this->maxValue != "null")
			{
				if($this->selected > $this->maxValue)
				{
					$this->class .= " " . $this->getErrorClass();
				}
			}
			elseif($this->minValue != "null")
			{
				if($this->selected < $this->minValue)
				{
					$this->class .= " " . $this->getErrorClass();
				}
			}
			$this->selected = number_format($this->selected, $this->precision, ".", "");
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