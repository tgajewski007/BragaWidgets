<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;

/**
 *
 * @package enmarket
 * @author Tomasz.Gajewski
 * Created on 2008-07-14 12:27:37
 * klasa odpowiedzialna za wygenerowanie formatki wyboru daty
 */
class DateField extends \braga\widgets\base\TextField
{
	use ClassFactory;
	// -------------------------------------------------------------------------
	protected $class = null;
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
		$this->onFocus .= "\$(this).select();";
		if(empty($this->maxLength))
		{
			$this->setMaxLength(10);
		}
		$this->onBlur .= "CheckDate(this," . ($this->required ? "true" : "false") . ",\"" . $this->minValue . "\",\"" . $this->maxValue . "\");";
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->setDefaults();
		if($this->required)
		{
			if($this->selected == "")
			{
				$this->class .= " " . $this->getErrorClass();
			}
		}
		$this->setClassString($this->class);
		$retval = BaseTags::p(parent::out(), "style='min-height:25px;'");
		$retval .= BaseTags::script("\$(\"#" . $this->id . "\").watermark(\"RRRR-MM-DD\");\$(\"#" . $this->id . "\").datepicker({" . $this->minValueString . $this->maxValueString . " onClose: function(date, req, minDate, maxDate) {CheckDate(\$(this)," . ($this->required ? "true" : "false") . ",\"" . $this->minValue . "\",\"" . $this->maxValue . "\")}});");
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>