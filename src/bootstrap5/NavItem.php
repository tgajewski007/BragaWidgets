<?php
namespace braga\widgets\bootstrap5;
use braga\tools\html\HtmlComponent;
use braga\tools\html\BaseTags;
class NavItem extends HtmlComponent
{
	// -----------------------------------------------------------------------------------------------------------------
	const CLASS_ITEM = "nav-item";
	// -----------------------------------------------------------------------------------------------------------------
	protected $content;
	protected $active;
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @var NavSubItem[]
	 */
	protected $items = [];
	// -----------------------------------------------------------------------------------------------------------------
	function __construct($content, bool $active = false)
	{
		$this->content = $content;
		$this->active = $active;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function additem(NavSubItem $item)
	{
		$this->items[] = $item;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function out()
	{
		if(count($this->items) == 0)
		{
			return BaseTags::li($this->content, "class='" . self::CLASS_ITEM . ($this->active ? " active" : "") . "'");
		}
		else
		{
			$retval = "";
			foreach($this->items as $item)
			{
				$retval .= $item->out();
			}
			$retval = BaseTags::ul($retval, "class='dropdown-menu'");
			return BaseTags::li($this->content . $retval, "class='" . self::CLASS_ITEM . ($this->active ? "  active" : "") . " dropdown'");
		}
	}
	// -----------------------------------------------------------------------------------------------------------------
}
