<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;

/**
 * Created on 08-04-2011 11:42:29
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class MemoField extends Field
{
	// -------------------------------------------------------------------------
	protected $maxLength = 65535;
	// -------------------------------------------------------------------------
	public function setMaxLength($maxLength)
	{
		$this->maxLength = $maxLength;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->attrib = null;
		$this->onFocus .= "\$(this).addClass(\"widgetHighLight a ui-state-highlight\");\$(this).css(\"z-index\",3);";
		$this->onBlur .= "\$(this).removeClass(\"widgetHighLight a ui-state-highlight\");\$(this).css(\"z-index\",0);";
		$this->classString .= " " . Field::CLASS_SIZE_MED;
		if($this->required)
		{
			$this->onKeyUp .= "CzyNull(this);";
			if($this->selected == "")
			{
				$this->classString .= " " . Field::CLASS_ERROR;
			}
		}
		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addAttrib("rows", "0");
		$this->addAttrib("cols", "0");
		$this->addEvents();
		$this->addCustomAttrib();
		$tmp = BaseTags::div(Tags::textarea($this->selected, $this->attrib), "style='min-height:85px;'");

		return $tmp;
	}
	// -------------------------------------------------------------------------
}
?>