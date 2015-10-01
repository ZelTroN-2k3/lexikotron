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
		$this->context->smarty->assign(array(
			'title' => Configuration::get('LXK_PAGE_TITLE'),
			'glossaries' => $glossaries
		));

		$this->setTemplate('lexipage.tpl');
	}
}