<?php

/*
 *  @author Mario Johnathan <xanou.dev@gmail.com>
 */

if (!defined('_PS_VERSION_'))
  exit;

include_once(_PS_MODULE_DIR_.'lexikotron/models/Glossary.php');
 
class Lexikotron extends Module
{
	/**
	 * @see Module::__construct()
	 */
	public function __construct()
	{
		$this->name = 'lexikotron';
		$this->tab = 'front_office_features';
		$this->version = '1.0.0';
		$this->author = 'Mario Johnathan';
		$this->need_instance = 0;
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_); 

		parent::__construct();

		$this->displayName = $this->l('Lexikotron');
		$this->description = $this->l('Lexikotron is a module to make a glossary');

		$this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
	}


	/**
	 * @see Module::install()
	 */
	public function install()
	{
		if (
			!parent::install()
			|| !$this->createTables()
			|| !Configuration::updateValue('LXK_PAGE_TITLE', 'Glossary')
		)
			return false;
		return true;
	}

	/**
	 * Creates tables
	 */
	protected function createTables()
	{
		$sql = Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'lexikotron` (
				`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`active` TINYINT(1) NOT NULL,
				`date_add` DATETIME NOT NULL,
				`date_edit` DATETIME NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;
		');

		$sql &=  Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'lexikotron_lang` (
				`id_lexikotron` int(10) unsigned NOT NULL,
			  	`id_lang` int(10) unsigned NOT NULL,
				`name` varchar(255) NOT NULL,
				`description` text NOT NULL
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=UTF8;
		');
		return $sql;
	}

	/**
	 * @see Module::uninstall()
	 */
	public function uninstall()
	{
		if (
			!parent::uninstall()
			|| !$this->deleteTables()
		)
			return false;
		return true;
	}

	/**
	 * Deletes tables
	 */
	protected function deleteTables()
	{
		$sql = Db::getInstance()->execute('
			DROP TABLE IF EXISTS `'._DB_PREFIX_.'lexikotron`;
		');

		$sql &= Db::getInstance()->execute('
			DROP TABLE IF EXISTS `'._DB_PREFIX_.'lexikotron_lang`;
		');

		return $sql;
	}

	/**
	 * Creates a configuration page
	 */
	public function getContent()
	{
		$output = '';
 
	    if (Tools::isSubmit('submit'.$this->name))
	    {
	        $page_title = strval(Tools::getValue('LXK_PAGE_TITLE'));
	        if (!$page_title || empty($page_title))
	            $output .= $this->displayError($this->l('Invalid page title'));
	        else
	        {
	            Configuration::updateValue('LXK_PAGE_TITLE', $page_title);
	            $output .= $this->displayConfirmation($this->l('Settings updated'));
	        }
	    }
	    return $output.$this->displayForm();

	}

	/**
	 * Displays form for adding/editing glossaries
	 */
	public function displayForm()
	{
	    $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
	     
	    $fields_form[0]['form'] = array(
	        'legend' => array(
	            'title' => $this->l('Settings'),
	        ),
	        'input' => array(
	            array(
	                'type' => 'text',
	                'label' => $this->l('Title of page'),
	                'name' => 'LXK_PAGE_TITLE',
	                'size' => 20,
	                'required' => true
	            ),
	            array(
				    'type'      => 'radio',                               
				    'label'     => $this->l('Enable pagination'),        
				    'name'      => 'LXK_PAGINATION',                              
				    'required'  => true,                                  
				    'class'     => 't',                                   
				    'is_bool'   => true,                                  
				    'values'    => array(                                 
				        array(
				            'id'    => 'lxk_pagination_on',                           
				            'value' => 1,                                     
				            'label' => $this->l('Yes')                    
				        ),
				        array(
				            'id'    => 'lxk_pagination_off',
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
	     
	    $helper = new HelperForm();
	     
	    // Module, token and currentIndex
	    $helper->module = $this;
	    $helper->name_controller = $this->name;
	    $helper->token = Tools::getAdminTokenLite('AdminModules');
	    $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
	     
	    // Language
	    $helper->default_form_language = $default_lang;
	    $helper->allow_employee_form_lang = $default_lang;
	     
	    // Title and toolbar
	    $helper->title = $this->displayName;
	    $helper->show_toolbar = true;      
	    $helper->toolbar_scroll = true;
	    $helper->submit_action = 'submit'.$this->name;
	    $helper->toolbar_btn = array(
	        'save' =>
	        array(
	            'desc' => $this->l('Save'),
	            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
	            '&token='.Tools::getAdminTokenLite('AdminModules'),
	        ),
	        'back' => array(
	            'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
	            'desc' => $this->l('Back to list')
	        )
	    );
	     
	    // Load current value
	    $helper->fields_value['LXK_PAGE_TITLE'] = Configuration::get('LXK_PAGE_TITLE');
	    $helper->fields_value['LXK_PAGINATION'] = Configuration::get('LXK_PAGINATION');
	     
	    return $helper->generateForm($fields_form);
	}
}