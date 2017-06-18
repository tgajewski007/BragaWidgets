<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\BaseTags;

/**
 * Created on 18.06.2017 18:50:35
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class BS
{
	// -------------------------------------------------------------------------
	public static function panel($title, $content)
	{
		$retval = "";
		$head = BaseTags::h3($title, "class='panel-title'");
		$retval = BaseTags::div($head, "class='panel-heading'");
		$retval .= BaseTags::div($content, "class='panel-body'");
		$retval = BaseTags::div($retval, "class='panel panel-default'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	public static function formRow($widget)
	{
		return BaseTags::div($widget, "class='form-group'");
	}
	// -------------------------------------------------------------------------
	public static function submit($label)
	{
		return BaseTags::input("type='submit' value='" . $label . "' class='btn btn-primary'");
	}
	// -------------------------------------------------------------------------
}