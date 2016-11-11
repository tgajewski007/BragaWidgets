<?php

namespace braga\widgets\jqueryui;

use braga\widgets\base\Field;

/**
 * Created on 11.11.2016 14:01:36
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
abstract class Field extends Field
{
	protected $classString = self::CLASS_BASE;
	// -------------------------------------------------------------------------
	const CLASS_BASE = "widget ui-widget-content ui-corner-all";
	const CLASS_SIZE_SMALL = "widgetSizeSmall";
	const CLASS_SIZE_MED = "widgetSizeMedium";
	const CLASS_SIZE_FULL = "widgetSizeFull";
	const CLASS_ERROR = "ui-state-error";
	protected $classString = self::CLASS_BASE;
	// -------------------------------------------------------------------------
}
?>