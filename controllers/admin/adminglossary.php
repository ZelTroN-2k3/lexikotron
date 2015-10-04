<?php

class AdminGlossaryController extends ModuleAdminController
{
	/**
	 * @see ModuleAdminController::__construct()
	 */
	public function __construct()
	{
		$this->table = 'lexikotron';
		$this->className = 'Glossary';
		$this->identifier = "id_lexikotron"; 
		$this->bootstrap = true;

		$this->_join= 'LEFT JOIN `'._DB_PREFIX_.'lexikotron_lang` ll ON (a.`id_lexikotron` = ll.`id_lexikotron`)';

		$this->_select = 'll.*';

		$this->fields_list = array(
		    'id' => array(
		        'title'	=> '#'
		    ),
		    'name' => array(
		        'title' => $this->l('Texte')
		    ),
		    'active' => array(
		        'title' => $this->l('Valider'),
		        'active' => 'status'
		    )
		);

		$this->actions = array('delete');

		parent::__construct();
	}
}