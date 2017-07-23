<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\BaseTags;

/**
 * Created on 2 lis 2013 11:49:32
 * @author Tomasz Gajewski
 * @package frontoffice
 * error prefix
 */
class PageNavi
{
	// -------------------------------------------------------------------------
	protected $ajax = false;
	protected $href;
	protected $iloscRecordow;
	protected $itemsPerPage;
	protected $iloscStron;
	protected $strona;
	protected $previewText = "&laquo;";
	protected $nextText = "&raquo;";
	protected $pageString = "%_PAGE_NO_STRING_%";

	// -------------------------------------------------------------------------
	public function setAjax($ajax)
	{
		$this->ajax = $ajax;
	}
	// -------------------------------------------------------------------------
	public function setHref($href)
	{
		$this->href = $href;
	}
	// -------------------------------------------------------------------------
	public function setIloscRecordow($iloscRecordow)
	{
		$this->iloscRecordow = $iloscRecordow;
	}
	// -------------------------------------------------------------------------
	public function setItemsPerPage($itemsPerPage)
	{
		$this->itemsPerPage = $itemsPerPage;
	}
	// -------------------------------------------------------------------------
	public function setIloscStron($iloscStron)
	{
		$this->iloscStron = $iloscStron;
	}
	// -------------------------------------------------------------------------
	public function setStrona($strona)
	{
		$this->strona = $strona;
	}
	// -------------------------------------------------------------------------
	public function setPreviewText($previewText)
	{
		$this->previewText = $previewText;
	}
	// -------------------------------------------------------------------------
	public function setNextText($nextText)
	{
		$this->nextText = $nextText;
	}
	// -------------------------------------------------------------------------
	public function setPageString($pageString)
	{
		$this->pageString = $pageString;
	}
	// -------------------------------------------------------------------------
	public function getAjax()
	{
		return $this->ajax;
	}
	// -------------------------------------------------------------------------
	public function getHref()
	{
		return $this->href;
	}
	// -------------------------------------------------------------------------
	public function getIloscRecordow()
	{
		return $this->iloscRecordow;
	}
	// -------------------------------------------------------------------------
	public function getItemsPerPage()
	{
		return $this->itemsPerPage;
	}
	// -------------------------------------------------------------------------
	public function getIloscStron()
	{
		return $this->iloscStron;
	}
	// -------------------------------------------------------------------------
	public function getStrona()
	{
		return $this->strona;
	}
	// -------------------------------------------------------------------------
	public function getPreviewText()
	{
		return $this->previewText;
	}
	// -------------------------------------------------------------------------
	public function getNextText()
	{
		return $this->nextText;
	}
	// -------------------------------------------------------------------------
	public function getPageString()
	{
		return $this->pageString;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->init();

		if($this->getIloscStron() > 1)
		{
			$retval = $this->getPreviewPage();
			if($this->getIloscStron() > 15)
			{
				$retval .= $this->getBodyFragment();
			}
			else
			{
				$retval .= $this->getBodyFull();
			}
			$retval .= $this->getNextPage();

			$retval = BaseTags::ul($retval, "class='pagination pagination-lg'");
			$retval = BaseTags::nav($retval);
			return $retval;
		}
	}
	// -------------------------------------------------------------------------
	protected function getBodyFragment()
	{
		$retval = "";
		if($this->getStrona() < 7)
		{
			$startDot = "";
			$endDot = BaseTags::li(BaseTags::a("...", "href='#'"));
			$href = $this->getHrefTranslated($this->iloscStron);
			if($this->getAjax())
			{
				$endDot .= BaseTags::li(BaseTags::ajaxLink($href, $this->iloscStron));
			}
			else
			{
				$endDot .= BaseTags::li(BaseTags::a($this->iloscStron, "href='" . $href . "'"));
			}
			$fromCount = 1;
			$endCount = 11;
		}
		elseif($this->getStrona() > ($this->getIloscStron() - 6))
		{
			$href = $this->getHrefTranslated(1);
			if($this->getAjax())
			{
				$startDot = BaseTags::li(BaseTags::ajaxLink("1", $href));
			}
			else
			{
				$startDot = BaseTags::li(BaseTags::a("1", "href='" . $href . "'"));
			}
			$startDot .= BaseTags::li(BaseTags::a("...", "href='#'"));
			$endDot = "";
			$fromCount = $this->getIloscStron() - 10;
			$endCount = $this->getIloscStron();
		}
		else
		{
			$href = $this->getHrefTranslated(1);
			if($this->getAjax())
			{
				$startDot = BaseTags::li(BaseTags::ajaxLink("1", $href));
			}
			else
			{
				$startDot = BaseTags::li(BaseTags::a("1", "href='" . $href . "'"));
			}
			$startDot .= BaseTags::li(BaseTags::a("...", "href='#'"));
			$endDot = BaseTags::li(BaseTags::a("...", "href='#'"));
			$href = $this->getHrefTranslated($this->iloscStron);
			if($this->getAjax())
			{
				$endDot .= BaseTags::li(BaseTags::ajaxLink($this->iloscStron, $href));
			}
			else
			{
				$endDot .= BaseTags::li(BaseTags::a($this->iloscStron, "href='" . $href . "'"));
			}
			$fromCount = $this->getStrona() - 5;
			$endCount = $this->getStrona() + 5;
		}
		$retval .= $startDot;
		for($a = $fromCount; $a <= $endCount; $a++)
		{
			if($a == $this->getStrona())
			{
				$retval .= BaseTags::li(BaseTags::a($a, "href='#'"), "class='active'");
			}
			else
			{
				$href = $this->getHrefTranslated($a);

				if($this->getAjax())
				{
					$retval .= BaseTags::li(BaseTags::ajaxLink($a, $href));
				}
				else
				{
					$retval .= BaseTags::li(BaseTags::a($a, "href='" . $href . "'"));
				}
			}
		}
		$retval .= $endDot;
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getBodyFull()
	{
		$retval = "";
		for($a = 1; $a <= $this->getIloscStron(); $a++)
		{
			if($a != $this->getStrona())
			{
				$href = $this->getHrefTranslated($a);
				if($this->ajax)
				{
					$retval .= BaseTags::li(BaseTags::ajaxLink($a, $href));
				}
				else
				{
					$retval .= BaseTags::li(BaseTags::a($a, "href='" . $href . "'"));
				}
			}
			else
			{
				$retval .= BaseTags::li(BaseTags::a($a, "href='#'"), "class='active'");
			}
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getNextPage()
	{
		if($this->getStrona() != $this->getIloscStron())
		{
			$href = $this->getHrefTranslated($this->getStrona() + 1);
			if($this->getAjax())
			{
				return BaseTags::li(BaseTags::ajaxLink($this->getNextText(), $href));
			}
			else
			{
				return BaseTags::li(BaseTags::a($this->getNextText(), "href='" . $href . "'"));
			}
		}
		else
		{
			return BaseTags::li(BaseTags::a($this->getNextText(), "href='#'"));
		}
	}
	// -------------------------------------------------------------------------
	protected function getPreviewPage()
	{
		if($this->getStrona() != 1)
		{
			$href = $this->getHrefTranslated($this->getStrona() - 1);
			if($this->getAjax())
			{
				return BaseTags::li(BaseTags::ajaxLink($this->getPreviewText(), $href));
			}
			else
			{
				return BaseTags::li(BaseTags::a($this->getPreviewText(), "href='" . $href . "'"));
			}
		}
		else
		{
			return BaseTags::li(BaseTags::a($this->getPreviewText(), "href='#'"));
		}
	}
	// -------------------------------------------------------------------------
	protected function getHrefTranslated($strona)
	{
		return str_replace($this->getPageString(), $strona, $this->href);
	}
	// -------------------------------------------------------------------------
	protected function init()
	{
		if(is_null($this->getIloscStron()))
		{
			$this->setIloscStron(ceil($this->getIloscRecordow() / $this->getItemsPerPage()));
		}
		if(strpos($this->getHref(), $this->getPageString()) === false)
		{
			$this->setHref($this->getHref() . $this->getPageString());
		}
	}
	// -------------------------------------------------------------------------
}
?>