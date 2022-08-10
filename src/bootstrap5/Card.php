<?php
namespace braga\widgets\bootstrap5;
use braga\tools\html\HtmlComponent;
use braga\tools\html\BaseTags;
class Card extends HtmlComponent
{
	protected $header;
	protected $content;
	protected $footer;
	// -----------------------------------------------------------------------------------------------------------------
	public function __construct($header = null, $content = null, $footer = null)
	{
		$this->header = $header;
		$this->content = $content;
		$this->footer = $footer;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public function out()
	{
		$retval = "";
		if(!empty($this->header))
		{
			$retval .= BaseTags::div($this->header, "class='card-header'");
		}
		$retval .= BaseTags::div($this->content, "class='card-body'");
		if(!empty($this->footer))
		{
			$retval .= BaseTags::div($this->footer, "class='card-footer'");
		}
		$retval = BaseTags::div($retval, "class='card'");
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param string $header
	 */
	public function setHeader($header)
	{
		$this->header = $header;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param Ambigous <string, unknown> $content
	 */
	public function setContent($content)
	{
		$this->content = $content;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param string $footer
	 */
	public function setFooter($footer)
	{
		$this->footer = $footer;
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function getContentTitle($title, $class = "card-title")
	{
		return BaseTags::h5($title, "class='" . $class . "'");
	}
	// -----------------------------------------------------------------------------------------------------------------
	public static function getContentSubTitle($subTitle, $class = "card-subtitle text-muted")
	{
		return BaseTags::h6($subTitle, "class='" . $class . "'");
	}
	// -----------------------------------------------------------------------------------------------------------------
}
