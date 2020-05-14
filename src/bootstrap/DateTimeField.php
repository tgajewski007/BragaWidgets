<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\BaseTags;
class DateTimeField extends TextField
{
	use AddLabels;
	use ClassFactory;
	use AddValidationMessage;
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
		$this->addAttrib("autocomplete", "off");
		$this->addAttrib("placeholder", "RRRR-MM-DD");
		$this->addAttrib("pattern", "(\d{4})-(\d{2})-(\d{2})");

		if($this->required)
		{
			if($this->selected == "")
			{
				$class .= " has-error";
			}
		}
		$showCalendarButton = BaseTags::button(faicon("fa-calendar"), "class='btn btn-default' type='button' onclick='\$(\"#" . $this->id . "\").data('DateTimePicker').show();'");
		$showCalendarButton = BaseTags::span($showCalendarButton, "class='input-group-btn'");
		$retval = BaseTags::div(parent::out() . $showCalendarButton, "class='input-group'");
		$label = $this->getLabel();
		return BaseTags::div($label . $retval . $this->getValidationMessage(), "class='" . $class . "'") . BaseTags::script("\$(\"#" . $this->id . "\").datetimepicker({format:\"YYYY-MM-DD HH:mm\",locale:\"pl\", sideBySide : true});");
	}
	// -------------------------------------------------------------------------
}
