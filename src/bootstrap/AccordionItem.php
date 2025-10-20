<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\HtmlComponent;
/**
 * Created on 03.07.2017 21:52:00
 * @author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class AccordionItem extends HtmlComponent
{
	// -----------------------------------------------------------------------------------------------------------------
	public function __construct(protected ?string $id = null, protected ?string $title = null)
	{
	}
	// -----------------------------------------------------------------------------------------------------------------
	protected ?string $onShowJavaScript = null;
	protected ?string $onLoadJavaScript = null;
	// -----------------------------------------------------------------------------------------------------------------
	protected ?string $idAccordion = null;
	public function setIdAccordion(string $idAccordion): void
	{
		$this->idAccordion = $idAccordion;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function setActive(bool $active): void
	{
		$this->active = $active;
	}
	// -----------------------------------------------------------------------------------------------------------------
	protected bool $active = false;
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	protected function getOnShowJavaScript()
	{
		return $this->onShowJavaScript;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	protected function getOnLoadJavaScript()
	{
		return $this->onLoadJavaScript;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param mixed $onShowJavaScript
	 */
	public function setOnShowJavaScript($onShowJavaScript)
	{
		$this->onShowJavaScript = $onShowJavaScript;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param mixed $onLoad
	 */
	public function setOnLoadJavaScript($onLoad)
	{
		$this->onLoadJavaScript = $onLoad;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param $colapseTitle
	 * @return void
	 * @deprecated use setTitle
	 */
	public function setColapseTitle($colapseTitle)
	{
		if(empty($this->title))
		{
			$this->title = $colapseTitle;
		}
		else
		{
			$this->title .= $colapseTitle;
		}
	}
	// -----------------------------------------------------------------------------------------------------------------
	protected function getTitle()
	{
		return $this->title;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function setTitle($title)
	{
		$this->title = $title;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param $activeTitle
	 * @return void
	 * @deprecated use setTitle
	 */
	public function setActiveTitle($activeTitle)
	{
		if(empty($this->title))
		{
			$this->title = $activeTitle;
		}
		else
		{
			$this->title .= $activeTitle;
		}
	}
	// -----------------------------------------------------------------------------------------------------------------
	protected function getContent()
	{
		return $this->content;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function setContent($content)
	{
		$this->content = $content;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function getId()
	{
		return $this->id;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function setId($id)
	{
		$this->id = $id;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function out()
	{
		$isShow = $this->active ? " show" : "";
		$isColapsed = $this->active ? "" : " collapsed";
		return <<<HTML
			<div class="accordion-item">
				<h2 class="accordion-header bg-body-tertiary">
					<button class="accordion-button{$isColapsed}" type="button" data-bs-toggle="collapse" data-bs-target="#{$this->getId()}" aria-expanded="true" aria-controls="{$this->getId()}">
						{$this->getTitle()}
					</button>
				</h2>
				<div id="{$this->getId()}" class="accordion-collapse collapse{$isShow}" data-bs-parent="#{$this->idAccordion}">
					<div class="accordion-body">
						{$this->getContent()}
					</div>
				</div>
			</div>
			HTML;
	}
	// -----------------------------------------------------------------------------------------------------------------
}