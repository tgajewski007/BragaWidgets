<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\BaseTags;

/**
 *
 * @author Tomasz.Gajewski
 * Created on 2016-07-14 12:27:37
 * klasa odpowiedzialna za wygenerowanie formatki wyboru daty
 */
class DateField extends TextField
{
	// -------------------------------------------------------------------------
	protected $minValue = null;
	protected $maxValue = null;
	protected $minValueString = null;
	protected $maxValueString = null;
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
		$this->class .= $this->getBaseClass();
		$this->class .= " " . $this->getMediumSizeClass();
		// $this->onFocus .= "\$(this).select();";
		if(empty($this->maxLength))
		{
			$this->setMaxLength(10);
		}
		// $this->onBlur .= "CheckDate(this," . ($this->required ? "true" : "false") . ",\"" . $this->minValue . "\",\"" . $this->maxValue . "\");";
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
		$input = parent::out();
		$input .= BaseTags::button(faicon("fa-calendar"), "class='btn btn-default' type='button' onclick='\$(\"#" . $this->id . "\").datepicker(\"show\")'");
		$retval = BaseTags::span($input, "class='input-group-btn'");
		$retval = BaseTags::div($retval, "class='input-group'");
		$label = $this->getLabel();
		return BaseTags::div($label . $input, "class='" . $class . "'") . BaseTags::script("\$(\"#" . $this->id . "\").datepicker({format:\"yyyy-mm-dd\"});");
	}
	// -------------------------------------------------------------------------
}
?>