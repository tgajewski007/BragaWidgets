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
	public static function box($title, $content, $baseClass = 'panel-default')
	{
		$retval = "";
		$head = BaseTags::h3($title, "class='panel-title'");
		$retval = BaseTags::div($head, "class='panel-heading'");
		$retval .= BaseTags::div($content, "class='panel-body'");
		$retval = BaseTags::div($retval, "class='panel " . $baseClass . "'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	public static function panel($content, $baseClass = 'panel-default')
	{
		$retval = "";
		$retval .= BaseTags::div($content, "class='panel-body'");
		$retval = BaseTags::div($retval, "class='panel " . $baseClass . "'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	public static function formRow($widget, $addHasError = false)
	{
		return BaseTags::div($widget, "class='form-group" . ($addHasError ? " hasError" : "") . "'");
	}
	// -------------------------------------------------------------------------
	public static function viewLine($desc, $real)
	{
		$retval = BaseTags::div($desc, "class='col-xs-12 col-sm-6 col-md-4 col-md-3'") . BaseTags::div(BaseTags::b($real), "class='col-xs-12 col-sm-6 col-md-8 col-md-9'");
		$retval = BaseTags::div($retval, "class='row'");
		$retval = BaseTags::div($retval, "class='form-group'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	public static function submit($label, $baseClass = 'btn-default btn-block')
	{
		return BaseTags::input("type='submit' value='" . $label . "' class='btn " . $baseClass . "'");
	}
	// -------------------------------------------------------------------------
	public static function button($content, $attrb, $baseClass = "btn-default btn-block")
	{
		return BaseTags::button($content, $attrb . " class='btn " . $baseClass . "'");
	}
	// -------------------------------------------------------------------------
	public static function listGroup($content)
	{
		return BaseTags::div($content, "class='list-group'");
	}
	// -------------------------------------------------------------------------
	public static function listItemAjaxLink($href, $label, $defaultClass = "")
	{
		$onClick = "onclick='ajax.go(this); return false;' ";
		$class = "class='" . $defaultClass . " list-group-item list-group-item-action' ";
		$href = "href='" . $href . "' ";
		return BaseTags::a($label, $href . $class . $onClick);
	}
	// -------------------------------------------------------------------------
	public static function listGroupItemAjax($label, $labelHref, $iconHref, $idContener)
	{
		$defaultClass = "";
		$onClick = "onclick='return ajax.go(this);' ";
		$class = "class='" . $defaultClass . " list-group-item list-group-item-action' ";
		$labelHref = "href='" . $labelHref . "' ";
		$iconHref = faIcon("fa-caret-right fa-lg fa-fw", "onclick='listGroupItemAjax(event, this,\"" . $idContener . "\",\"" . $iconHref . "\");return false;'");

		return BaseTags::a($iconHref . $label, $labelHref . $class . $onClick) . BaseTags::div("", "id='" . $idContener . "' class='hidden' style='padding-left:8px;'");
	}
	// -------------------------------------------------------------------------
	public static function treeItemList($activeLink, $branchContent)
	{
		$idContener = getRandomString(8);
		$openCloseIcon = faIcon("fa-caret-right fa-lg fa-fw", "class='hand' onclick='\$(\"#" . $idContener . "\").toggle(); $(this).toggleClass(\"fa-caret-right\"); $(this).toggleClass(\"fa-caret-down\"); '");

		$retval = BaseTags::span($openCloseIcon . $activeLink, "class='list-group-item list-group-item-action' ");
		$retval .= BaseTags::div($branchContent, "id='" . $idContener . "' style='padding-left:8px;display: none;'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	/**
	 * @param string $label
	 * @param string $name
	 * @param string $value
	 * @param string $required
	 * @param number $maxLength
	 * @return string
	 */
	public static function textField($label, $name, $value = null, $required = false, $maxLength = 255)
	{
		$field = new TextField();
		$field->setRequired($required);
		$field->setName($name);
		$field->setSelected($value);
		$field->setLabel($label);
		$field->setMaxLength($maxLength);
		return $field->out();
	}
	// -------------------------------------------------------------------------
	/**
	 * @param string $label
	 * @param string $name
	 * @param string $value
	 * @param string $required
	 * @param number $maxLength
	 * @return string
	 */
	public static function memoField($label, $name, $value = null, $required = false, $maxLength = 65535)
	{
		$field = new MemoField();
		$field->setRequired($required);
		$field->setName($name);
		$field->setSelected($value);
		$field->setLabel($label);
		$field->setMaxLength($maxLength);
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
	/**
	 * @param string $label
	 * @param string $name
	 * @param boolean $checked
	 * @param string $value
	 * @return string
	 */
	public static function checkbox2($label, $name, $checked = false, $value = null)
	{
		$id = $name;
		if(strpos($name, "[") !== false)
		{
			$id = substr($name, 0, strlen($name) - 2);
		}

		$checkedClass = 'fa-check-square-o';
		$unCheckedClass = 'fa-square-o';
		$onChange = "onchange='if(\$(this).prop(\"checked\")){\$(this).parent().removeClass(\"" . $unCheckedClass . "\"); \$(this).parent().addClass(\"" . $checkedClass . "\");}else{\$(this).parent().removeClass(\"" . $checkedClass . "\"); \$(this).parent().addClass(\"" . $unCheckedClass . "\");} return false;'";
		$retval = BaseTags::input("type='checkbox' class='h' id='" . $id . "' name='" . $name . "' " . ($checked ? "checked" : "") . " value='" . $value . "' " . $onChange);
		$onClick = "onclick='\$(this).children().first().click();'";
		$retval = BaseTags::i($retval, "class='fa fa-lg fa-fw " . ($checked ? $checkedClass : $unCheckedClass) . "' " . $onClick . " style='float:left;'");
		if(!empty($label))
		{
			$label = BaseTags::label($label, "for='" . $id . "' style='display:inline;'");
		}
		$retval = BaseTags::div($retval . $label, "style='clear:both; padding:4px 0px'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	/**
	 * @param string $label
	 * @param string $name
	 * @param boolean $checked
	 * @return string
	 */
	public static function checkbox($label, $name, $checked = false)
	{
		$field = new CheckBoxField();
		$field->setName($name);
		$field->setSelected($checked);
		$field->setLabel($label);
		return $field->out();
	}
	// -------------------------------------------------------------------------
	/**
	 * @param string $label
	 * @param string $name
	 * @param string $value
	 * @param string $required
	 * @return string
	 */
	public static function dateField($label, $name, $value, $required = false)
	{
		$field = new DateField();
		$field->setName($name);
		$field->setSelected($value);
		$field->setLabel($label);
		$field->setRequired($required);
		return $field->out();
	}
	// -------------------------------------------------------------------------
	public static function fileField($label, $name, $baseClass = 'btn-default')
	{
		$i = BaseTags::input("type='file' id='" . $name . "' name='" . $name . "' class='h'");
		$i = BaseTags::label("Przeglądaj " . $i, "class='btn block " . $baseClass . "'");
		$l = BaseTags::label($label, "for='" . $name . "'");
		return self::formRow($l . $i) . BaseTags::script("initBSFileField('" . $name . "')");
	}
	// -------------------------------------------------------------------------
	public static function fileFieldAjax($label, $name, $baseClass = 'btn-default')
	{
		$id = getRandomStringLetterOnly(10);
		$i = BaseTags::input("type='file' id='" . $id . "' name='" . $name . "' class='h'");
		$i = BaseTags::label("Przeglądaj " . $i, "class='btn block " . $baseClass . "'");
		$i .= BaseTags::input("type='hidden' name='" . $name . "' id='" . $id . "_hidden'");
		$l = BaseTags::label($label, "for='" . $id . "'");
		$fn = BaseTags::input("type='hidden' id='" . $id . "_file_name' name='" . $name . "_file_name'");
		// $fn = BaseTags::label("nazwa pliku" . $fn, "class='btn block " . $baseClass . "'");
		return self::formRow($l . $i . $fn) . BaseTags::script("fileFieldAjax.initBSFileFieldAjax('" . $id . "')");
		/*
		 * Kod do system.js
		 * var fileFieldAjax =
		 * {
		 * initBSFileFieldAjax: function(idSender)
		 * {
		 * $(document).ready(function()
		 * {
		 * $('#' + idSender).on('fileselect', function(event, numFiles, label)
		 * {
		 * $('#' + idSender).parent().contents().first()[0].textContent = 'Wybrano plik: ' + label;
		 * });
		 * document.getElementById(idSender).addEventListener('change', fileFieldAjax.readFileContent, false);
		 * document.getElementById(idSender).idToWriteFileName = idSender + '_file_name';
		 * });
		 * },
		 * readFileContent: function(evt)
		 * {
		 * var files = evt.target.files; // FileList object
		 * var f = files[0];
		 * var reader = new FileReader();
		 * var hiddenId = '#' + this.id + '_hidden';
		 * reader.addEventListener("load", function()
		 * {
		 * $(hiddenId).val(reader.result);
		 * if(evt.target.idToWriteFileName.length > 0)
		 * {
		 * $('#' + evt.target.idToWriteFileName).val(f.name);
		 * }
		 * }
		 * , false);
		 * reader.readAsDataURL(f);
		 * }
		 * }
		 */
	}
	// -------------------------------------------------------------------------
	public static function numericField($label, $name, $value, $required = false, $precision = 0)
	{
		$field = new FloatField();
		$field->setLabel($label);
		$field->setName($name);
		$field->setSelected($value);
		$field->setRequired($required);
		$field->setPrecision($precision);
		return $field->out();
	}
	// -------------------------------------------------------------------------
	public static function getToolTip($txt, $position = "auto")
	{
		return "title='" . $txt . "' data-toggle='tooltip' data-placement='" . $position . "'";
	}
	// -------------------------------------------------------------------------
}