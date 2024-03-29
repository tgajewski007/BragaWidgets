<?php
namespace braga\widgets\bootstrap5;
use braga\tools\html\BaseTags;
use braga\widgets\base\TextField;

/**
 * @author Tomasz.Gajewski
 * Created on 2016-07-14 12:27:37
 * klasa odpowiedzialna za wygenerowanie formatki wyboru daty
 */
class DateField extends TextField
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

		$atr = [];
		$atr[] = "name='" . $this->name . "'";
		$atr[] = "id='id_" . $this->name . "'";
		$atr[] = "value='" . $this->selected . "'";
		$atr[] = "autocomplete='off'";
		$atr[] = "class='form-control'";
		$atr[] = "placeholder='RRRR-MM-DD'";
		$atr[] = "pattern='(\d{4})-(\d{2})-(\d{2})'";
		$atr[] = "onfocus='\$(\"#" . $this->id . "\").data(\"DateTimePicker\").show();" . $this->onFocus . "'";
		$atr[] = "onchange='" . $this->onChange . "'";
		$atr[] = "onblur='" . $this->onBlur . "'";
		$atr[] = "onkeydown='" . $this->onKeyDown . "'";
		$atr[] = "onkeyup='" . $this->onKeyUp . "'";
		$atr[] = "onmouseout='" . $this->onMouseOut . "'";
		$atr[] = "onmouseover='" . $this->onMouseOver . "'";
		$atr[] = "onmouseout='" . $this->onMouseOut . "'";
		if($this->required)
		{
			$atr[] = "required='true'";
		}

		$input = BaseTags::input(implode(" ", $atr));
		$showCalendarButton = BaseTags::span("", "class='glyphicon glyphicon-calendar'");
		$showCalendarButton = BaseTags::span($showCalendarButton, "class='input-group-addon'");
		$retval = BaseTags::div($input . $showCalendarButton, "class='input-group date' id='" . $this->id . "'");
		$label = $this->getLabel();
		$script = <<<JS
		$("#{$this->id}").datetimepicker(
		{
			format: "YYYY-MM-DD",
			locale: "pl"
		}).on("dp.change", function(){\$("#id_{$this->name}").trigger("change");});
JS;

		return BaseTags::div($label . $retval . $this->getValidationMessage(), "class='" . $class . "'") . BaseTags::script($script);
	}
	// -------------------------------------------------------------------------
}