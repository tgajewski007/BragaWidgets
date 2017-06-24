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
	public static function listItem($content = "")
	{
		$class = "class='label ' ";
		$onClick = "onclick='\$(\"h3.label \").removeClass(\"label-primary\") ;\$(this).addClass(\"label-primary\");' ";
		return BaseTags::h4(BaseTags::span($content, $class . $onClick));
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @param string $name
	 * @param string $value
	 * @param string $required
	 * @param string $multiline
	 * @param number $maxLength
	 * @return string
	 */
	public static function textField($name, $value = null, $required = false, $multiline = false, $maxLength = 255)
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
		return $field->out();
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
	public static function textLabelField($label, $name, $value = null, $required = false, $multiline = false, $maxLength = 255)
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
}