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
	 * @var AccordionItem[]
	 */
	protected array $items = [];
	// -------------------------------------------------------------------------
	public function __construct(protected ?string $id = null)
	{
		if(empty($id))
		{
			$this->id = "A" . getRandomString(8);
		}
	}
	// -------------------------------------------------------------------------
	public function setActiveItem($id)
	{
		if(isset($this->items[$id]))
		{
			$this->items[$id]->setActive(true);
		}
	}
	// -------------------------------------------------------------------------
	public function addItem(AccordionItem $item, $active = false)
	{
		$item->setActive($active);
		$item->setIdAccordion($this->id);
		$this->items[$item->getId()] = $item;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		foreach($this->items as $item)
		{
			$this->content .= $item->out();
		}
		return <<<HTML
			<div class="accordion" id="{$this->id}">
				{$this->content}
			</div>
			HTML;
	}
	// -------------------------------------------------------------------------
}