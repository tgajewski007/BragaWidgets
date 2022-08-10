<?php
namespace braga\widgets\bootstrap5;
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
	use AddLabels;
	use AddValidationMessage;
	// -------------------------------------------------------------------------
	public function out()
	{
		$input = parent::out();
		$retval = $input . BaseTags::label($this->label);
		return BaseTags::div($retval . $this->getValidationMessage(), "class='checkbox'");
	}
	// -------------------------------------------------------------------------
}
?>