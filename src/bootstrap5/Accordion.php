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
			$content = BaseTags::div($item->getContent(), "class='panel-body'");
			$content = BaseTags::div($content, "id='" . $item->getId() . "' class='panel-collapse collapse " . ($item->getId() == $this->openIdItem ? "in" : "") . "'");

			$heading = BaseTags::a($item->getColapseTitle(), "data-toggle='collapse' data-parent='#" . $idAccordion . "' href='#" . $item->getId() . "'");
			$heading .= $item->getActiveTitle();
			$heading = BaseTags::h4($heading, 'class="panel-title"');
			$heading = BaseTags::div($heading, 'class="panel-heading"');

			$rndId = getRandomStringLetterOnly(8);
			$retval .= BaseTags::div($heading . $content, 'class="panel panel-default" id="' . $rndId . '"');
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
		return BaseTags::div($retval, "id='" . $idAccordion . "' class='panel-group' ") . (empty($script) ? "" : BaseTags::script($script));
	}
	// -------------------------------------------------------------------------
}