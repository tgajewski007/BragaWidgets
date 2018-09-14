<?php
namespace braga\widgets\bootstrap;

/**
 * Created on 11.11.2016 21:54:08
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class DBGrid extends \braga\widgets\base\DBGrid
{
	// -------------------------------------------------------------------------
	protected $tableClass = "table table-striped table-condensed table-hover table-bordered";
	protected $headerRowClass = "";
	protected $headerCellClass = "";
	protected $contentRowClass = "";
	protected $contentNumericCellClass = "r";
	protected $contentStringCellClass = "";
	protected $contentDateCellClass = "c";
	protected $rowClass = array(
					"" );
	// -------------------------------------------------------------------------
	protected function getLinkAction()
	{
		if($this->ajaxEnablad)
		{
			return "onclick='return ajax.go(this);'";
		}
	}
	// -------------------------------------------------------------------------
}
?>