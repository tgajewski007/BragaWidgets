<?php
namespace braga\widgets\jqueryui;

/**
 * create 18-05-2012 19:47:30
 * @author Tomasz Gajewski
 * @package common
 */
class DBGrid extends \braga\widgets\base\DBGrid
{
	// -------------------------------------------------------------------------
	protected $tableClass = "sto ui-widget-content";
	protected $headerRowClass = "ui-state-highlight";
	protected $headerCellClass = "";
	protected $contentRowClass = "";
	protected $contentNumericCellClass = "r";
	protected $contentStringCellClass = "l";
	protected $contentDateCellClass = "c";
	protected $rowClass = array(
			"ui-state-default",
			"ui-state-focus");
	// -------------------------------------------------------------------------
	private $hoverAction;
	private $clickAction;
	// -------------------------------------------------------------------------
	protected function getHoverAction()
	{
		if(empty($this->hoverAction))
		{
			$this->hoverAction = "onmouseover='$(this).addClass(\"ui-state-hover\");' ";
			$this->hoverAction .= "onmouseout='$(this).removeClass(\"ui-state-hover\");' ";
		}
		return $this->hoverAction;
	}
	// -------------------------------------------------------------------------
	protected function getClickAction()
	{
		if(empty($this->clickAction))
		{
			$this->clickAction = "onclick='$(\"tr\").removeClass(\"ui-state-active\");$(this).addClass(\"ui-state-active\");' ";
		}
		return $this->clickAction;
	}
	// -------------------------------------------------------------------------
}
?>