<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\HtmlComponent;
use braga\tools\tools\SessManager;
use braga\tools\html\BaseTags;
/**
 * Created on 05.09.2016 22:43:01
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
class MessageView extends HtmlComponent
{
	// -------------------------------------------------------------------------
	public function out()
	{
		$retval = $this->getAlerts();
		$retval .= $this->getWarning();
		$retval .= $this->getInfo();
		$retval .= $this->getSqlError();
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getAlerts()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_ALERT))
		{
			foreach(SessManager::get(SessManager::MESSAGE_ALERT) as $m)/* @var $m \braga\tools\tools\Message */
			{
				$id = "MSG" . getRandomString(5);
				$w = BaseTags::span($m->getOpis() . BaseTags::sup($m->getNumer(), "class='i' style='padding-left:8px;font-size:75%;'"));
				$button = BaseTags::button(BaseTags::span("&times;", 'aria-hidden="true"'), 'type="button" class="close" data-dismiss="alert" aria-label="Close"');
				$retval .= BaseTags::div($w . $button, "class='alert alert-danger alert-dismissible' role='alert' id='" . $id . "'");
				$retval .= BaseTags::script("$(\"#" . $id . "\").delay(10000).fadeOut();");
			}
			SessManager::kill(SessManager::MESSAGE_ALERT);
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getWarning()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_WARNING))
		{
			foreach(SessManager::get(SessManager::MESSAGE_WARNING) as $m)/* @var $m \braga\tools\tools\Message */
			{
				$id = "MSG" . getRandomString(5);
				$w = BaseTags::span($m->getOpis() . BaseTags::sup($m->getNumer(), "class='i' style='padding-left:8px;font-size:75%;'"));
				$button = BaseTags::button(BaseTags::span("&times;", 'aria-hidden="true"'), 'type="button" class="close" data-dismiss="alert" aria-label="Close"');
				$retval .= BaseTags::div($w . $button, "class='alert alert-warning alert-dismissible' role='alert' id='" . $id . "'");
				$retval .= BaseTags::script("$(\"#" . $id . "\").delay(5000).fadeOut();");
			}
			SessManager::kill(SessManager::MESSAGE_WARNING);
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getInfo()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_INFO))
		{
			foreach(SessManager::get(SessManager::MESSAGE_INFO) as $m)/* @var $m \braga\tools\tools\Message */
			{
				$id = "MSG" . getRandomString(5);
				$w = BaseTags::span($m->getOpis());
				$button = BaseTags::button(BaseTags::span("&times;", 'aria-hidden="true"'), 'type="button" class="close" data-dismiss="alert" aria-label="Close"');
				$retval .= BaseTags::div($w . $button, "class='alert alert-success alert-dismissible' role='alert' id='" . $id . "'");
				$retval .= BaseTags::script("$(\"#" . $id . "\").delay(5000).fadeOut();");
			}
			SessManager::kill(SessManager::MESSAGE_INFO);
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getSqlError()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_SQL))
		{
			foreach(SessManager::get(SessManager::MESSAGE_SQL) as $m)/* @var $m \braga\tools\tools\Message */
			{
				$id = "MSG" . getRandomString(5);
				$w = BaseTags::span($m->getOpis() . BaseTags::sup($m->getNumer(), "class='i' style='padding-left:8px;font-size:75%;'"));
				$button = BaseTags::button(BaseTags::span("&times;", 'aria-hidden="true"'), 'type="button" class="close" data-dismiss="alert" aria-label="Close"');
				$retval .= BaseTags::div($w . $button, "class='alert alert-danger alert-dismissible' role='alert' id='" . $id . "'");
			}
			SessManager::kill(SessManager::MESSAGE_SQL);
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>