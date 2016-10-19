<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;
/**
 * Created on 08-04-2011 11:42:29
 * @author Tomasz.Gajewski
 * @package enmarket
 * error prefix
 */
class TextField extends Field
{
	// -------------------------------------------------------------------------
	protected $maxLength = 255;
	protected $type = "text";
	protected $readOnly = false;
	protected $watermark = "";
	protected $regExPatern = null;
	// -------------------------------------------------------------------------
	public function setMaxLength($maxLength)
	{
		$this->maxLength = $maxLength;
	}
	// -------------------------------------------------------------------------
	public function setRegExpPatern($patern)
	{
		$this->regExPatern = $patern;
	}
	// -------------------------------------------------------------------------
	public function setType($type)
	{
		$this->type = $type;
	}
	// -------------------------------------------------------------------------
	public function setWaterMark($watermark)
	{
		$this->watermark = $watermark;
	}
	// -------------------------------------------------------------------------
	public function setReadOnly($readOnly = true)
	{
		$this->readOnly = $readOnly;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->onFocus .= "\$(this).select();";
		$this->attrib = null;
		$checkScript = "";
		$this->classString .= " " . Field::CLASS_SIZE_MED;
		if($this->readOnly)
		{
			$this->addAttrib("readonly", "readonly");
		}
		else
		{
			$this->onFocus .= "\$(this).addClass(\"widgetHighLight ui-state-highlight\");";
			$this->onBlur .= "\$(this).removeClass(\"widgetHighLight ui-state-highlight\");";
		}
		if($this->required)
		{
			if($this->selected == "")
			{
				$this->onKeyUp = "CzyNull(this);" . $this->onKeyUp;
				$this->classString .= " " . Field::CLASS_ERROR;
			}
			$checkScript = "if(!checkIsNull(this)){return false};";
		}
		if(!is_null($this->regExPatern))
		{
			$checkScript .= "if(!checkRegExPatern(this,\"" . $this->regExPatern . "\")){return false};";
		}

		$this->onChange = $this->onChange . $checkScript;
		$this->onBlur = $this->onBlur . $checkScript;
		$this->onKeyUp = $this->onKeyUp . $checkScript;

		$this->addAttrib("type", $this->type);
		$this->addAttrib("id", $this->name);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("maxlength", $this->maxLength);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("value", $this->selected);
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addAttrib("placeholder", $this->watermark);
		$this->addEvents();
		$this->addCustomAttrib();

		return BaseTags::input($this->attrib);
	}
	// -------------------------------------------------------------------------
}
?>