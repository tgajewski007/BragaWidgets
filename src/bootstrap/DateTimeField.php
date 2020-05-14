<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\BaseTags;
use braga\widgets\base\TextField;
/**
 * @author Tomasz.Gajewski
 * Created on 2020-05-14 12:27:37
 * klasa odpowiedzialna za wygenerowanie formatki wyboru daty i czasu
 */
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

		if($this->required)
		{
			if($this->selected == "")
			{
				$class .= " has-error";
			}
		}
		$showCalendarButton = BaseTags::button(faicon("fa-calendar"), "class='btn btn-default' type='button''");
		$showCalendarButton = BaseTags::span($showCalendarButton, "class='input-group-btn'");
		$retval = BaseTags::div(BaseTags::input("name='" . $this->id . "' autocomplete='off' placeholder='RRRR-MM-DD GG:MM' pattern='(\d{4})-(\d{2})-(\d{2} (\d{2}):(\d{2})' onfocus='\$(\"#" . $this->id . "\").data('DateTimePicker').show();") . $showCalendarButton, "class='input-group' id='" . $this->id . "'");
		$label = $this->getLabel();
		return BaseTags::div($label . $retval . $this->getValidationMessage(), "class='" . $class . "'") . BaseTags::script("\$(\"#" . $this->id . "\").datetimepicker({format:\"YYYY-MM-DD HH:mm\",locale:\"pl\", sideBySide : true});");
	}
	// -------------------------------------------------------------------------
}
