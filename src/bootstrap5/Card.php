<?php
namespace braga\widgets\bootstrap5;
use braga\tools\html\HtmlComponent;
use braga\tools\html\BaseTags;
class Card extends HtmlComponent
{
	// -----------------------------------------------------------------------------------------------------------------
	public function __construct(protected ?string $header = null, ?string $content = null, protected ?string $footer = null)
	{
		$this->content = $content;
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
		return BaseTags::div($retval, "class='card'");
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
	 * @param string $content
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
