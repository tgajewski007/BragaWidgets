<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;
use Braga\WidgetItem;

/**
 * Created on 10-06-2011 10:45:23
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class DropDownListField extends Field
{
	// -------------------------------------------------------------------------
	const CLASS_OPTION = "ui-state-default";
	const CLASS_OPTIONGROUP = "ui-priority-primary";
	// -------------------------------------------------------------------------
	protected $dane = array();
	protected $group = false;
	protected $requiredText = "-=Wybierz=-";
	// -------------------------------------------------------------------------
	public function addItem(WidgetItem $item)
	{
		$this->dane[] = $item;
	}
	// -------------------------------------------------------------------------
	public function enableGrouping()
	{
		$this->group = true;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->attrib = null;
		$retval = "";
		if($this->group)
		{
			if($this->required)
			{
				if(null === $this->selected)
				{
					$attrib = "class='" . self::CLASS_OPTION . " " . Field::CLASS_BASE . " " . Field::CLASS_ERROR . "' value='' ";
					$optGroup = BaseTags::option($this->requiredText, $attrib);
					$retval .= BaseTags::optgroup($optGroup, "class='" . self::CLASS_OPTIONGROUP . " " . Field::CLASS_BASE . "' label='" . $this->requiredText . "'");
					$this->classString .= " " . Field::CLASS_ERROR;
				}
			}
			$marker = null;
			$optGroup = null;
			foreach($this->dane as $value) /*  @var $value WidgetItem */
			{
				if(null === $marker)
				{
					$marker = $value->getGroupDesc();
				}
				else
				{
					if($marker != $value->getGroupDesc())
					{
						$retval .= BaseTags::optgroup($optGroup, "class='" . self::CLASS_OPTIONGROUP . " " . Field::CLASS_BASE . "' label='" . $marker . "'");
						$marker = $value->getGroupDesc();
						$optGroup = null;
					}
				}

				$innerHtml = $value->getDesc();
				$attrib = "class='" . self::CLASS_OPTION . "' value='" . $value->getVal() . "' " . $value->getCustomAttrib();
				if($this->selected == $value->getVal())
				{
					$attrib .= " selected='selected'";
				}
				$optGroup .= BaseTags::option($innerHtml, $attrib);
			}
			if(null !== $optGroup)
			{
				$retval .= BaseTags::optgroup($optGroup, "class='" . self::CLASS_OPTIONGROUP . " " . Field::CLASS_BASE . "' label='" . $marker . "'");
			}
		}
		else
		{
			if($this->required)
			{
				if(null === $this->selected)
				{
					$attrib = "class='" . self::CLASS_OPTION . " " . Field::CLASS_ERROR . "' value='' ";
					$retval .= BaseTags::option($this->requiredText, $attrib);
					$this->classString .= " " . Field::CLASS_ERROR;
				}
			}
			foreach($this->dane as $value)
			{
				$innerHtml = $value->getDesc();
				$attrib = "class='" . self::CLASS_OPTION . "' value='" . $value->getVal() . "' " . $value->getCustomAttrib();
				if($this->selected == $value->getVal())
				{
					$attrib .= " selected='selected'";
				}
				$retval .= BaseTags::option($innerHtml, $attrib);
			}
		}

		$this->onChange .= "SprawdzCombo(this);";
		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("class", $this->classString . " combo");
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addEvents();
		$this->addCustomAttrib();
		return BaseTags::select($retval, $this->attrib);
	}
	// -------------------------------------------------------------------------
}
?>