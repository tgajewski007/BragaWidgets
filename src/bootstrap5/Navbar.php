<?php
namespace braga\widgets\bootstrap5;
use braga\tools\html\BaseTags;
use braga\tools\html\HtmlComponent;
class Navbar extends HtmlComponent
{
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @var NavItem[]
	 */
	protected $items = [];
	protected $brandContent = "Start";
	protected $navClass = "navbar navbar-expand-lg navbar-dark bg-dark sticky-top";
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param string $brandContent
	 */
	public function setBrandContent($brandContent)
	{
		$this->brandContent = $brandContent;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param string $navClass
	 */
	public function setNavClass($navClass)
	{
		$this->navClass = $navClass;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function addItem(NavItem $item)
	{
		$this->items[] = $item;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function out()
	{
		$retval = "";

		$idNavbar = getRandomStringLetterOnly(10);
		$retval .= $this->getBrandButton($idNavbar);
		$retval .= $this->getItems($idNavbar);

		$retval = BaseTags::div($retval, "class='container-fluid'");
		$retval = BaseTags::nav($retval, "class='" . $this->navClass . "'");
		return $retval;
	}
	// -----------------------------------------------------------------------------------------------------------------
	private function getItems($idNavbar)
	{
		$retval = "";

		foreach($this->items as $item)
		{
			$retval .= $item->out();
		}
		$retval = BaseTags::ul($retval, "class='navbar-nav me-auto mb-2 mb-lg-0'");
		$retval = BaseTags::div($retval, "class='collapse navbar-collapse' id='" . $idNavbar . "'");
		return $retval;
	}
	// -----------------------------------------------------------------------------------------------------------------
	private function getBrandButton($idNavbar)
	{
		$retval = BaseTags::a($this->brandContent, "class='navbar-brand' href='/'");
		$tmp = BaseTags::span("", "class='navbar-toggler-icon'");
		$retval .= BaseTags::button($tmp, 'class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#' . $idNavbar . '" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"');
		return $retval;
	}
	// -----------------------------------------------------------------------------------------------------------------
}
