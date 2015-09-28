<?php

class LexikotronLexipageModuleFrontController extends ModuleFrontController
{
	/**
	 * @see ModuleFrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		$glossaries = Glossary::getGlossaries($this->context->language->id);
		$this->context->smarty->assign('glossaries', $glossaries);

		$this->setTemplate('lexipage.tpl');
	}
}