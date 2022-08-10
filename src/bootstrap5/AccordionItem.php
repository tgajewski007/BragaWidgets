<?php
namespace braga\widgets\bootstrap5;
/**
 * Created on 03.07.2017 21:52:00
 * @author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class AccordionItem
{
	// -------------------------------------------------------------------------
	protected $colapseTitle;
	protected $activeTitle;
	protected $content;
	protected $id;
	protected $onShowJavaScript;
	protected $onLoadJavaScript;
	// ------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	public function getOnShowJavaScript()
	{
		return $this->onShowJavaScript;
	}
	// ------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	public function getOnLoadJavaScript()
	{
		return $this->onLoadJavaScript;
	}
	// ------------------------------------------------------------------------
	/**
	 * @param mixed $onShowJavaScript
	 */
	public function setOnShowJavaScript($onShowJavaScript)
	{
		$this->onShowJavaScript = $onShowJavaScript;
	}
	// ------------------------------------------------------------------------
	/**
	 * @param mixed $onLoad
	 */
	public function setOnLoadJavaScript($onLoad)
	{
		$this->onLoadJavaScript = $onLoad;
	}
	// ------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	public function getUrlDynamicContent()
	{
		return $this->onLoadJavaScript;
	}
	// -------------------------------------------------------------------------
	public function getColapseTitle()
	{
		return $this->colapseTitle;
	}
	// -------------------------------------------------------------------------
	public function setColapseTitle($colapseTitle)
	{
		$this->colapseTitle = $colapseTitle;
	}
	// -------------------------------------------------------------------------
	public function getActiveTitle()
	{
		return $this->activeTitle;
	}
	// -------------------------------------------------------------------------
	public function setActiveTitle($activeTitle)
	{
		$this->activeTitle = $activeTitle;
	}
	// -------------------------------------------------------------------------
	public function getContent()
	{
		return $this->content;
	}
	// -------------------------------------------------------------------------
	public function setContent($content)
	{
		$this->content = $content;
	}
	// -------------------------------------------------------------------------
	public function getId()
	{
		return $this->id;
	}
	// -------------------------------------------------------------------------
	public function setId($id)
	{
		$this->id = $id;
	}
	// -------------------------------------------------------------------------
}