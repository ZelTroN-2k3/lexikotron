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
	 * @see AdminController::renderList()
	 */
	public function renderList()
	{
		$this->fields_list = array(
		    'id_lexikotron' => array(
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
	 * @see AdminController::renderForm()
	 */
	public function renderForm()
	{
		$this->fields_form = array(
			'tinymce' => true,
			'legend' => array(
				'title' => $this->l('Glossary'),
				'image' => '../img/admin/cog.gif'
			),
			'input' => array(
				array(
					'type' => 'text',
					'lang' => true,
					'label' => $this->l('Name:'),
					'name' => 'name'
				),
				array(
					'type' => 'textarea',
					'label' => $this->l('Description:'),
					'name' => 'description',
					'lang' => true
				),
	            array(
				    'type'      => 'radio',                               
				    'label'     => $this->l('Enabled'),        
				    'name'      => 'active',                              
				    'required'  => true,                                  
				    'class'     => 't',                                   
				    'is_bool'   => true,                                  
				    'values'    => array(                                 
				        array(
				            'id'    => 'glossary_on',                           
				            'value' => 1,                                     
				            'label' => $this->l('Yes')                    
				        ),
				        array(
				            'id'    => 'glossary_off',
				            'value' => 0,
				            'label' => $this->l('No')
				        )
				    ),
				),
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

	
	/**
	 * @see AdminController::postProcess()
	 */
	public function postProcess()
	{
		// var_dump(Tools::getValue('active')); exit;
		if (Tools::isSubmit('submitAdd'.$this->table))
		{
			
		}

		return parent::postProcess();
	}
}