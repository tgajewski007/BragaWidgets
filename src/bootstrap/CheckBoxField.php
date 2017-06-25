<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 13:50:16
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class CheckBoxField extends \braga\widgets\base\CheckBoxField
{
	// -------------------------------------------------------------------------
	protected $label = null;
	// -------------------------------------------------------------------------
	public function setLabel($label)
	{
		$this->label = $label;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$input = parent::out();
		$retval = BaseTags::label($input . $this->label);
		return BaseTags::div($retval, "class='checkbox'");
	}
	// -------------------------------------------------------------------------
}
?>