<?php
namespace braga\widgets\base;
use braga\tools\html\BaseTags;

/**
 * Created on 17-05-2011 07:55:40
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class FloatField extends Field
{
	// -------------------------------------------------------------------------
	protected $minValue = "null";
	protected $maxValue = "null";
	protected $precision = 2;
	protected $maxLength = 22;
	protected $type = "number";
	protected $readOnly = false;
	protected $step = "0.01";
	// -------------------------------------------------------------------------
	public function setReadOnly($readOnly = true)
	{
		$this->readOnly = $readOnly;
	}
	// -------------------------------------------------------------------------
	public function setMaxLength($maxLength)
	{
		$this->maxLength = $maxLength;
	}
	// -------------------------------------------------------------------------
	public function setType($type)
	{
		$this->type = $type;
	}
	// -------------------------------------------------------------------------
	public function setMinValue($minValue)
	{
		$this->minValue = $minValue;
	}
	// -------------------------------------------------------------------------
	public function setMaxValue($maxValue)
	{
		$this->maxValue = $maxValue;
	}
	// -------------------------------------------------------------------------
	public function setPrecision($precision)
	{
		$this->precision = $precision;
		$this->setStep(pow(10, -$precision));
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->addAttrib("type", $this->type);
		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("value", $this->selected);
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addAttrib("maxlength", $this->maxLength);
		$this->addAttrib("step", $this->step);
		if($this->maxValue !== "null")
		{
			$this->addAttrib("max", $this->maxValue);
		}
		if($this->minValue !== "null")
		{
			$this->addAttrib("min", $this->minValue);
		}
		if($this->required)
		{
			$this->addAttrib("required", "true");
		}
		if($this->readOnly)
		{
			$this->addAttrib("readonly", "readonly");
		}
		$this->addEvents();
		$this->addCustomAttrib();
		return BaseTags::input($this->attrib);
	}
	// -------------------------------------------------------------------------
	public function setStep(string $step): void
	{
		$this->step = $step;
	}
	// -------------------------------------------------------------------------
}