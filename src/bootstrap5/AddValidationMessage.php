<?php
namespace braga\widgets\bootstrap5;
use braga\tools\html\BaseTags;
/**
 * Created on 23 sty 2018 09:32:02
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
trait AddValidationMessage
{
	// -----------------------------------------------------------------------------------------------------------------
	protected $messageWhenValidatePass;
	protected $messageWhenValidateFail;
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	public function getMessageWhenValidatePass()
	{
		return $this->messageWhenValidatePass;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @return mixed
	 */
	public function getMessageWhenValidateFail()
	{
		return $this->messageWhenValidateFail;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param mixed $messageWhenValidatePass
	 */
	public function setMessageWhenValidatePass($messageWhenValidatePass)
	{
		$this->messageWhenValidatePass = $messageWhenValidatePass;
	}
	// -----------------------------------------------------------------------------------------------------------------
	/**
	 * @param mixed $messageWhenValidateFail
	 */
	public function setMessageWhenValidateFail($messageWhenValidateFail)
	{
		$this->messageWhenValidateFail = $messageWhenValidateFail;
	}
	// -----------------------------------------------------------------------------------------------------------------
	protected function getValidationMessage()
	{
		$invalidFeedback = BaseTags::div($this->getMessageWhenValidatePass(), "class='help-block with-errors'");
		return $invalidFeedback;
	}
	// -----------------------------------------------------------------------------------------------------------------
}