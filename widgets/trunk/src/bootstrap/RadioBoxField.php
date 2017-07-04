<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\BaseTags;

/**
 * Created on 04.07.2017 23:02:01
 * @author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class RadioBoxField extends \braga\widgets\base\RadioBoxField
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
		return BaseTags::div($retval, "class='radio'");
	}
	// -------------------------------------------------------------------------
}