<?php

class LexikotronLexipageModuleFrontController extends ModuleFrontController
{
	/**
	 * @see ModuleFrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		$glossaries = Glossary::getGlossaries($this->context->language->id, array(), null, null, null, null, true);
		$alphabet = $this->getAlphabets($glossaries);

		$criteria = array();
		if(Tools::getValue('k'))
		{
			$criteria['k'] = Tools::getValue('k');
		}
		else if(count($alphabet))
		{
			$criteria['k'] = $alphabet[0];	
		}

		$filtered_list = Glossary::getGlossaries($this->context->language->id, $criteria, null, null, null, null, true);

		$this->context->smarty->assign(array(
			'title' => Configuration::get('LXK_PAGE_TITLE'),
			'current' => isset($criteria['k']) ? $criteria['k'] : null,
			'alphabet' => $alphabet, 
			'glossaries' => $filtered_list,
			'pagination_templates' => dirname(__FILE__).'/../../views/templates/front/pagination.tpl'
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