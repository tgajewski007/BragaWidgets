<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\HtmlComponent;
use braga\tools\html\BaseTags;

/**
 * Created on 26.06.2017 23:07:50
 * @author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class TabBox extends HtmlComponent
{
	private $boxId;
	private $tabs;
	private $item;
	private $ajax;
	private $minHeight;
	private $defaultTab;
	private $idActiveTab;
	// -------------------------------------------------------------------------
	public function __construct()
	{
		$this->tabs = array();
		$this->item = 0;
		$this->ajax = "onclick='return ajax.go(this)'";
		$this->boxId = "";
		$this->minHeight = 300;
		$this->defaultTab = 1;
	}
	// -------------------------------------------------------------------------
	public function setDefaultTab($id)
	{
		$this->defaultTab = $id;
	}
	// -------------------------------------------------------------------------
	public function disableAjax()
	{
		$this->ajax = "";
	}
	// -------------------------------------------------------------------------
	public function setMinHeight($height)
	{
		$this->minHeight = intval($height);
	}
	// -------------------------------------------------------------------------
	public function setBoxId($id)
	{
		$this->boxId = "id='" . $id . "'";
	}
	// -------------------------------------------------------------------------
	public function getIdActiveTab()
	{
		return $this->idActiveTab;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$tabOk = false;
		foreach($this->tabs as $value)
		{
			if($value["id"] == $this->idActiveTab)
			{
				$tabOk = true;
			}
		}
		if(!$tabOk)
		{
			$activeId = $this->defaultTab;
		}
		$retval = "";
		if($this->item > 0)
		{
			for($i = 0; $i < $this->item; $i++)
			{
				if($activeId == $this->tabs[$i]["id"])
				{
					$retval .= $this->menuActive($this->tabs[$i]["desc"], $this->tabs[$i]["href"]);
				}
				else
				{
					$retval .= $this->menuPassive($this->tabs[$i]["desc"], $this->tabs[$i]["href"]);
				}
			}
			$retval = BaseTags::ul($retval, "class='nav nav-tabs'");
			$retval .= BaseTags::div($this->content, "class='ui-corner-bottom ui-widget-content' style='padding:4px;min-height:300px' " . $this->boxId . " ");
			$retval = BaseTags::div($retval, "class='ui-tabs ui-corner-all'");
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	public function addTab($id, $opis, $href)
	{
		$this->tabs[$this->item]["id"] = $id;
		$this->tabs[$this->item]["desc"] = $opis;
		$this->tabs[$this->item]["href"] = $href;
		$this->item++;
	}
	// -------------------------------------------------------------------------
	private function menuPassive($opis, $href)
	{
		$retval = BaseTags::li(BaseTags::a($opis, $this->ajax . " href='" . $href . "'"));
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function menuActive($opis, $href)
	{
		$retval = BaseTags::li(BaseTags::a($opis, $this->ajax . " href='" . $href . "'"), "class='active' role='presentation'");
		return $retval;
	}

	// -------------------------------------------------------------------------
}