<?php
namespace braga\widgets\bootstrap5;
use braga\tools\html\HtmlComponent;
use braga\tools\html\BaseTags;

/**
 * Created on 03.07.2017 21:50:24
 * @author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class Accordion extends HtmlComponent
{
	// -------------------------------------------------------------------------
	/**
	 * @var AccordionItem[]
	 */
	protected $items = array();
	protected $openIdItem;
	// -------------------------------------------------------------------------
	public function setActiveItem($id)
	{
		$this->openIdItem = $id;
	}
	// -------------------------------------------------------------------------
	public function addItem(AccordionItem $item, $active = false)
	{
		$this->items[$item->getId()] = $item;
		if($active)
		{
			$this->openIdItem = $item->getId();
		}
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$idAccordion = "A" . getRandomString(8);
		$retval = "";
		$script = "";
		foreach($this->items as $item)
		{
			$content = $this->getItemBody($item);
			$heading = $this->getItemHeader($item, $idAccordion);

			$rndId = getRandomStringLetterOnly(8);

			$retval .= BaseTags::div($heading . $content, 'class="accordion-item" id="' . $rndId . '"');
			if(!empty($item->getOnShowJavaScript()))
			{
				$script .= "\$(\"#" . $rndId . "\").on(\"show.bs.collapse\", function() {" . $item->getOnShowJavaScript() . "});";
				if($item->getId() == $this->openIdItem)
				{
					$script .= $item->getOnShowJavaScript();
				}
			}
			if(!empty($item->getOnLoadJavaScript()))
			{
				$script .= $item->getOnLoadJavaScript();
			}
		}
		return BaseTags::div($retval, "id='" . $idAccordion . "' class='accordion' ") . (empty($script) ? "" : BaseTags::script($script));
	}
	// -------------------------------------------------------------------------
	private function getItemHeader(AccordionItem $item, $idAccordion)
	{
		$attrb = "class='accordion-button' ";
		$attrb .= "type='button' ";
		$attrb .= "data-bs-toggle='collapse' ";
		$attrb .= "data-bs-target='#" . $idAccordion . "' ";
		$attrb .= "aria-expanded='" . ($item->getId() == $this->openIdItem ? "true" : "false") . "' ";
		$attrb .= "aria-controls='" . $idAccordion . "' ";

		$heading = BaseTags::button($item->getColapseTitle(), $attrb);
		$heading .= $item->getActiveTitle();
		$heading = BaseTags::h2($heading, 'class="accordion-header"');
		return $heading;
	}
	// -------------------------------------------------------------------------
	private function getItemBody(AccordionItem $item)
	{
		$content = BaseTags::div($item->getContent(), "class='accordion-body'");
		return BaseTags::div($content, "id='" . $item->getId() . "' class=accordion-collapse collapse " . ($item->getId() == $this->openIdItem ? "show" : "") . "'");
	}
	// -------------------------------------------------------------------------
}