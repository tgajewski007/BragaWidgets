<?php
namespace braga\widgets\bootstrap5;
use braga\tools\html\HtmlComponent;
use braga\tools\html\BaseTags;
class NavSubItem extends HtmlComponent
{
	// -----------------------------------------------------------------------------------------------------------------
	const CLASS_SUB_ITEM = "dropdown-item";
	// -----------------------------------------------------------------------------------------------------------------
	protected $content;
	// -----------------------------------------------------------------------------------------------------------------
	function __construct($content)
	{
		$this->content = $content;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function out()
	{
		return BaseTags::li($this->content);
	}
	// -----------------------------------------------------------------------------------------------------------------
}
