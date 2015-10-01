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
		$alphabet = $this->getAlphabets($glossaries);

		$filtered_list = Glossary::getGlossaries($this->context->language->id);

		$this->context->smarty->assign(array(
			'title' => Configuration::get('LXK_PAGE_TITLE'),
			'alphabet' => $alphabet, 
			'glossaries' => $glossaries
		));

		$this->setTemplate('lexipage.tpl');
	}

	/**
	 * Get all available alphabets from glossaries
	 * @param  array $glossaries 
	 * @return array            
	 */
	protected function getAlphabets($glossaries)
	{
		$alphabet = array();

		foreach($glossaries as $g)
		{
			$char = strtoupper(substr($g['name'], 0, 1));
			if($char !== false && !in_array($char, $alphabet))
			{
				$alphabet[] = $char;
			}
		}

		natsort($alphabet);

		return $alphabet;
	}
}