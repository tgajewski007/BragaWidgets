<?php

namespace braga\widgets\jqueryui;

use braga\tools\html\BaseTags;
use braga\db\DataSource;

/**
 * create 18-05-2012 19:47:30
 * @author Tomasz Gajewski
 * @package common
 */
class DBGrid
{
	// -------------------------------------------------------------------------
	/**
	 *
	 * @var DataSource
	 */
	protected $db = null;
	protected $columnCount = null;
	protected $content = null;
	// -------------------------------------------------------------------------
	protected $tableClass = "sto ui-widget-content";
	protected $headerRowClass = "ui-state-highlight";
	protected $headerCellClass = "";
	protected $contentRowClass = "";
	protected $contentNumericCellClass = "r";
	protected $contentStringCellClass = "l";
	protected $contentDateCellClass = "c";
	protected $rowClass = array(
			"ui-state-default",
			"ui-state-focus"
	);
	// -------------------------------------------------------------------------
	protected $headerOutput = true;
	protected $ajaxEnablad = true;
	protected $hrefCell = null;
	protected $hrefReplaceArray = array();
	protected $additionalColumn = array();
	protected $lpCounter = 1;
	// -------------------------------------------------------------------------
	protected $sortable = false;
	// -------------------------------------------------------------------------
	public function setHrefActionString($href)
	{
		$this->hrefCell = $href;
	}
	// -------------------------------------------------------------------------
	public function enableSortable()
	{
		$this->sortable = true;
	}
	// -------------------------------------------------------------------------
	public function addHrefReplaceStringByField(DBGridReplacer $tmp)
	{
		$this->hrefReplaceArray[] = $tmp;
	}
	// -------------------------------------------------------------------------
	public function addColumn(DBGridColumn $tmp)
	{
		$this->additionalColumn[] = $tmp;
	}
	// -------------------------------------------------------------------------
	public function limitColumnCount($columnCount)
	{
		$this->columnCount = $columnCount;
	}
	// -------------------------------------------------------------------------
	public function disableHeaderOutput($headerOutput = false)
	{
		$this->headerOutput = $headerOutput;
	}
	// -------------------------------------------------------------------------
	public function disableAjax($ajax = false)
	{
		$this->ajaxEnablad = $ajax;
	}
	// -------------------------------------------------------------------------
	public function setDataSource(DataSource $db)
	{
		$this->db = $db;
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @return string HtmlTableElement
	 * @param boolean $tagTable
	 */
	public function out($tagTable = true)
	{
		$this->init();
		$this->getHeader();
		$this->getTable();
		if($tagTable)
		{
			if($this->sortable)
			{
				$id = "tbl" . getRandomString(8);
				$retval = BaseTags::table($this->content, "class='" . $this->tableClass . "' id='" . $id . "'");
				$retval .= BaseTags::script("\$(\"#" . $id . "\").tablesorter({cssAsc: \"gridHeaderSortDown\", cssDesc: \"gridHeaderSortUp\", cssHeader: \"gridHeader\"});");
				return $retval;
			}
			else
			{
				return BaseTags::table($this->content, "class='" . $this->tableClass . "'");
			}
		}
		else
			return $this->content;
	}
	// -------------------------------------------------------------------------
	protected function init()
	{
		if(is_null($this->columnCount))
		{
			$this->columnCount = $this->db->getMetaData()->getColumnCount();
		}
	}
	// -------------------------------------------------------------------------
	protected function getHeader()
	{
		$tmp = BaseTags::th("L.p.", "class='" . $this->headerCellClass . "' style='width:10px;'");

		foreach($this->db->getMetaData() as $key => $meta)/* @var $meta DataSourceColumnMetaData */
		{
			if($key < $this->columnCount)
			{
				$tmp .= BaseTags::th($meta->getName(), "class='" . $this->headerCellClass . "'");
			}
		}
		// dodatkowe kolumny
		foreach($this->additionalColumn as $columna)
		{
			$tmp .= BaseTags::th($columna->columnName, "class='" . $this->headerCellClass . "'");
		}

		$this->content .= BaseTags::thead(BaseTags::tr($tmp, "class='" . $this->headerRowClass . "'"));
	}
	// -------------------------------------------------------------------------
	protected function getTable()
	{
		$retval = "";
		$a = 0;
		while($this->db->nextRecord())
		{
			$counter = $this->lpCounter + $a;
			$content = BaseTags::td($counter, "class='" . $this->contentNumericCellClass . "' style='padding-right:4px;'");
			for($i = 0; $i < $this->columnCount; $i++)
			{
				if(is_null($this->hrefCell))
				{
					switch($this->db->getMetaData()->get($i)->getType())
					{
						case "int":
							$content .= BaseTags::td(BaseTags::div($this->db->f($i)), "class='" . $this->contentNumericCellClass . "'");
							break;
						case "date":
							$content .= BaseTags::td(BaseTags::div($this->db->f($i)), "class='" . $this->contentDateCellClass . "'");
							break;
						default :
							$content .= BaseTags::td(BaseTags::div($this->db->f($i)), "class='" . $this->contentStringCellClass . "'");
							break;
					}
				}
				else
				{
					if($this->ajaxEnablad)
					{
						$tmp = BaseTags::a($this->db->f($i), "href='" . $this->hrefCell . "' onclick='return ajax.go(this);'");
					}
					else
					{
						$tmp = BaseTags::a($this->db->f($i), "href='" . $this->hrefCell . "'");
					}
					$tmp = $this->repleceStringByField($tmp);
					switch($this->db->getMetaData()->get($i)->getType())
					{
						case "int":
							$content .= BaseTags::td(BaseTags::div($tmp), "class='" . $this->contentNumericCellClass . "'");
							break;
						case "date":
							$content .= BaseTags::td(BaseTags::div($tmp), "class='" . $this->contentDateCellClass . "'");
							break;
						default :
							$content .= BaseTags::td(BaseTags::div($tmp), "class='" . $this->contentStringCellClass . "'");
							break;
					}
				}
			}
			// dodatkowe kolumny
			foreach($this->additionalColumn as $columna)
			{
				$content .= BaseTags::td($this->getCustomColumn($columna->columnContent), "class='" . $this->contentStringCellClass . "'");
			}
			$trRow = $this->rowClass[$a % count($this->rowClass)];
			$retval .= BaseTags::tr($content, "class='" . $this->contentRowClass . " " . $trRow . "'");
			$a++;
		}
		$this->content .= BaseTags::tbody($retval);
	}
	// -------------------------------------------------------------------------
	protected function getCustomColumn($columnContent)
	{
		return $this->repleceStringByField($columnContent);
	}
	// -------------------------------------------------------------------------
	protected function repleceStringByField($text)
	{
		foreach($this->hrefReplaceArray as $replacer)
		{
			$text = str_replace($replacer->stringToReplaceByFieldContent, $this->db->f($replacer->idField), $text);
		}
		return $text;
	}
	// -------------------------------------------------------------------------
}
?>