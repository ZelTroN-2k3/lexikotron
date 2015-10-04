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

		parent::__construct();
	}
	
	/**
	 * @see ModuleAdminController::renderList()
	 */
	public function renderList()
	{
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

		$this->actions = array('edit', 'delete');
        $this->bulk_actions = array(
        	'delete' => array(
        		'text' => $this->l('Delete selected'),
                'confirm' => $this->l('Delete selected items?')
        ));

		$lists = parent::renderList();

		parent::initToolbar();

		return $lists;
	}

	
	/**
	 * @see ModuleAdminController::renderForm()
	 */
	public function renderForm()
	{
		$this->fields_form = array(
			'tinymce' => true,
			'legend' => array(
				'title' => $this->l('Example'),
				// 'image' => '../img/admin/cog.gif'
			),
			'input' => array(
				array(
					'type' => 'text',
					'lang' => true,
					'label' => $this->l('Name:'),
					'name' => 'name',
					'size' => 40
				),
				array(
					'type' => 'textarea',
					'label' => $this->l('Description:'),
					'name' => 'description',
					'lang' => true,
					'size' => 40
				)
			),
			'submit' => array(
				'title' => $this->l('Save'),
				'class' => 'button'
			)
		);
		if (!($obj = $this->loadObject(true)))
			return;
		
		$this->fields_value = array('lorem' => 'ipsum');

		return parent::renderForm();
	}


	public function postProcess()
	{
		if (Tools::isSubmit('submitAdd'.$this->table))
		{
			$glossary = new Glossary();
			$glossary->date_add = new DateTime();
			$glossary->date_edit = new DateTime();
			$languages = Language::getLanguages(false);

			foreach ($languages as $language)
			{
				$glossary->name[$language['id_lang']] = Tools::getValue('name_'.$language['id_lang']);
				$glossary->description[$language['id_lang']] = Tools::getValue('description_'.$language['id_lang']);
			}

			if (!$glossary->save())
				$this->errors[] = Tools::displayError('An error has occurred: Can\'t save the current object');
			else
				Tools::redirectAdmin(self::$currentIndex.'&conf=4&token='.$this->token);
		}
	}
}