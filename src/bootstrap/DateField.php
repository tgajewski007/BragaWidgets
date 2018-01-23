<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\BaseTags;
use braga\widgets\base\TextField;

/**
 *
 * @author Tomasz.Gajewski
 * Created on 2016-07-14 12:27:37
 * klasa odpowiedzialna za wygenerowanie formatki wyboru daty
 */
class DateField extends TextField
{
	use AddLabels;
	use ClassFactory;
	// -------------------------------------------------------------------------
	protected $minValue = null;
	protected $maxValue = null;
	protected $minValueString = null;
	protected $maxValueString = null;
	protected $class = null;
	// -------------------------------------------------------------------------
	public function setMinValue($minValue)
	{
		$this->minValue = $minValue;
		$this->minValueString = "minDate: new Date(" . substr($minValue, 0, 4) . ", " . (intval(substr($minValue, 5, 2)) - 1) . "," . substr($minValue, 8, 2) . "), ";
	}
	// -------------------------------------------------------------------------
	public function setMaxValue($maxValue)
	{
		$this->maxValue = $maxValue;
		$this->maxValueString = "maxDate: new Date(" . substr($maxValue, 0, 4) . ", " . (intval(substr($maxValue, 5, 2)) - 1) . "," . substr($maxValue, 8, 2) . "), ";
	}
	// -------------------------------------------------------------------------
	protected function setDefaults()
	{
		$this->classString .= $this->getBaseClass();
		$this->classString .= " " . $this->getMediumSizeClass();
		if(empty($this->maxLength))
		{
			$this->setMaxLength(10);
		}
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$class = "form-group";
		$this->setDefaults();
		$this->addAttrib("placeholder", "RRRR-MM-DD");

		$this->onKeyUp .= "if(!checkRegExPatern(this,/(\d{4})-(\d{2})-(\d{2})/)){return};";
		$this->onBlur .= "if(!checkRegExPatern(this,/(\d{4})-(\d{2})-(\d{2})/)){return};";

		if($this->required)
		{
			$this->onKeyUp .= "if(!checkIsNull(this)){return};";
			$this->onBlur .= "if(!checkIsNull(this)){return};";
			if($this->selected == "")
			{
				$class .= " has-error";
			}
		}
		$showCalendarButton = BaseTags::button(faicon("fa-calendar"), "class='btn btn-default' type='button' onclick='\$(\"#" . $this->id . "\").datepicker(\"show\")'");
		$showCalendarButton = BaseTags::span($showCalendarButton, "class='input-group-btn'");
		$retval = BaseTags::div(parent::out() . $showCalendarButton, "class='input-group'");
		$label = $this->getLabel();
		return BaseTags::div($label . $retval, "class='" . $class . "'") . BaseTags::script("\$(\"#" . $this->id . "\").datepicker({format:\"yyyy-mm-dd\",language:\"pl\"});");
	}
	// -------------------------------------------------------------------------
}