<?php
namespace braga\widgets\bootstrap5;
use braga\tools\html\BaseTags;
use braga\tools\html\HtmlComponent;
use braga\tools\tools\Message;
/**
 * Created on 05.09.2016 22:43:01
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
class MessageView extends HtmlComponent
{
	// -----------------------------------------------------------------------------------------------------------------
	public function out()
	{
		$retval = $this->getAlerts();
		$retval .= $this->getWarning();
		$retval .= $this->getInfo();
		$retval .= $this->getSqlError();
		return $retval;
	}
	// -----------------------------------------------------------------------------------------------------------------
	protected function getAlerts()
	{
		$retval = "";
		foreach(Message::getInstance()->getAllByTyp(Message::MESSAGE_ALERT) as $m)
		/** @var \braga\tools\tools\Message $m  */
		{
			$id = "MSG" . getRandomString(5);
			$w = BaseTags::span($m->getOpis() . BaseTags::sup($m->getNumer(), "class='i' style='padding-left:8px;font-size:75%;'"));
			$button = BaseTags::button(BaseTags::span("&times;", 'aria-hidden="true"'), 'type="button" class="close" data-dismiss="alert" aria-label="Close"');
			$retval .= BaseTags::div($w . $button, "class='alert alert-danger alert-dismissible' role='alert' id='" . $id . "'");
			$retval .= BaseTags::script("$(\"#" . $id . "\").delay(10000).fadeOut();");
		}
		return $retval;
	}
	// -----------------------------------------------------------------------------------------------------------------
	protected function getWarning()
	{
		$retval = "";
		foreach(Message::getInstance()->getAllByTyp(Message::MESSAGE_WARNING) as $m)
		/** @var \braga\tools\tools\Message $m  */
		{
			$id = "MSG" . getRandomString(5);
			$w = BaseTags::span($m->getOpis() . BaseTags::sup($m->getNumer(), "class='i' style='padding-left:8px;font-size:75%;'"));
			$button = BaseTags::button(BaseTags::span("&times;", 'aria-hidden="true"'), 'type="button" class="close" data-dismiss="alert" aria-label="Close"');
			$retval .= BaseTags::div($w . $button, "class='alert alert-warning alert-dismissible' role='alert' id='" . $id . "'");
			$retval .= BaseTags::script("$(\"#" . $id . "\").delay(5000).fadeOut();");
		}
		return $retval;
	}
	// -----------------------------------------------------------------------------------------------------------------
	protected function getInfo()
	{
		$retval = "";
		foreach(Message::getInstance()->getAllByTyp(Message::MESSAGE_INFO) as $m)
		/** @var \braga\tools\tools\Message $m  */
		{
			$id = "MSG" . getRandomString(5);
			$w = BaseTags::span($m->getOpis());
			$button = BaseTags::button(BaseTags::span("&times;", 'aria-hidden="true"'), 'type="button" class="close" data-dismiss="alert" aria-label="Close"');
			$retval .= BaseTags::div($w . $button, "class='alert alert-success alert-dismissible' role='alert' id='" . $id . "'");
			$retval .= BaseTags::script("$(\"#" . $id . "\").delay(5000).fadeOut();");
		}
		return $retval;
	}
	// -----------------------------------------------------------------------------------------------------------------
	protected function getSqlError()
	{
		$retval = "";
		foreach(Message::getInstance()->getAllByTyp(Message::MESSAGE_SQL) as $m)
		/** @var \braga\tools\tools\Message $m  */
		{
			$id = "MSG" . getRandomString(5);
			$w = BaseTags::span($m->getOpis() . BaseTags::sup($m->getNumer(), "class='i' style='padding-left:8px;font-size:75%;'"));
			$button = BaseTags::button(BaseTags::span("&times;", 'aria-hidden="true"'), 'type="button" class="close" data-dismiss="alert" aria-label="Close"');
			$retval .= BaseTags::div($w . $button, "class='alert alert-danger alert-dismissible' role='alert' id='" . $id . "'");
		}
		return $retval;
	}
	// -----------------------------------------------------------------------------------------------------------------
}
?>