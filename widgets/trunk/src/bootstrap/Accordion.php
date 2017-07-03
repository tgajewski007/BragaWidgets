<?php
namespace braga\widgets\bootstrap;
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
	 *
	 * @var array
	 */
	protected $items;
	protected $openIdItem;
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
		foreach($this->items as $item)/* @var $item AccordionItem */
		{
			$content = BaseTags::div($item->getContent(), "class='panel-body'");
			$content = BaseTags::div($content, "id='" . $item->getId() . "' class='panel-collapse collapse " . ($item->getId() == $this->openIdItem ? "in" : "") . "'");

			$heading = BaseTags::a($item->getColapseTitle(), "data-toggle='collapse' data-parent='#" . $idAccordion . "' href='#" . $item->getId() . "'");
			$heading .= $item->getActiveTitle();
			$heading = BaseTags::h4($heading, 'class="panel-title"');
			$heading = BaseTags::div($heading, 'class="panel-heading"');

			$retval .= BaseTags::div($heading . $content, 'class="panel panel-default"');
		}
		return BaseTags::div($retval, "id='" . $idAccordion . "' class='panel-group' ");
	}
	// -------------------------------------------------------------------------
}