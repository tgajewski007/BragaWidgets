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
		$retval = BaseTags::div($retval, "class='panel panel-primary'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	public static function formRow($widget, $addHasError = false)
	{
		return BaseTags::div($widget, "class='form-group" . ($addHasError ? " hasError" : "") . "'");
	}
	// -------------------------------------------------------------------------
	public static function submit($label)
	{
		return BaseTags::input("type='submit' value='" . $label . "' class='btn btn-primary'");
	}
	// -------------------------------------------------------------------------
	public static function listGroup($content)
	{
		return BaseTags::div($content, "class='list-group'");
	}
	// -------------------------------------------------------------------------
	public static function listItemAjaxLink($href, $label, $defaultClass = "")
	{
		$onClick = "onclick='$(\"a.list-group-item\").removeClass(\"active\");$(this).addClass(\"active\"); return ajax.go(this);' ";
		$class = "class='" . $defaultClass . " list-group-item list-group-item-action' ";
		$href = "href='" . $href . "' ";
		return BaseTags::a($label, $href . $class . $onClick);
	}
	// -------------------------------------------------------------------------
	public static function listGroupItemAjax($label, $labelHref, $iconHref, $idContener)
	{
		$defaultClass = "";
		$onClick = "onclick='$(\"a.list-group-item\").removeClass(\"active\");$(this).addClass(\"active\"); return ajax.go(this);' ";
		$class = "class='" . $defaultClass . " list-group-item list-group-item-action' ";
		$labelHref = "href='" . $labelHref . "' ";
		$iconHref = faIcon("fa-caret-right fa-lg fa-fw", "onclick='listGroupItemAjax(event, this,\"" . $idContener . "\",\"" . $iconHref . "\");return false;'");

		return BaseTags::a($iconHref . $label, $labelHref . $class . $onClick) . BaseTags::div("", "id='" . $idContener . "' class='hidden' style='padding-left:8px;'");
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @param string $label
	 * @param string $name
	 * @param string $value
	 * @param string $required
	 * @param string $multiline
	 * @param number $maxLength
	 * @return unknown|string
	 */
	public static function textField($label, $name, $value = null, $required = false, $multiline = false, $maxLength = 255)
	{
		if($multiline)
		{
			$field = new MemoField();
		}
		else
		{
			$field = new TextField();
		}
		$field->setRequired($required);
		$field->setName($name);
		$field->setSelected($value);
		$field->setLabel($label);
		return $field->out();
	}
	// -------------------------------------------------------------------------
	public static function passwordField($label, $name, $value = null, $required = false)
	{
		$field = new TextField();
		$field->setType("password");
		$field->setRequired($required);
		$field->setName($name);
		$field->setSelected($value);
		$field->setLabel($label);
		return $field->out();
	}
	// -------------------------------------------------------------------------
	public static function checkbox($label, $name, $checked = false)
	{
		$field = new CheckBoxField();
		$field->setName($name);
		$field->setSelected($checked);
		$field->setLabel($label);
		return $field->out();
	}
	// -------------------------------------------------------------------------
	public static function fileField($label, $name)
	{
		$i = BaseTags::input("type='file' id='" . $name . "' name='" . $name . "' class='h'");
		$i = BaseTags::label("Przeglądaj " . $i, "class='btn btn-default block'");
		$l = BaseTags::label($label, "for='" . $name . "'");
		return self::formRow($l . $i) . BaseTags::script("initBSFileField('" . $name . "')");
	}
	// -------------------------------------------------------------------------
}