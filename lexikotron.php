<?php

if (!defined('_PS_VERSION_'))
  exit;
 
class Lexikotron extends Module
{
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
		if (!parent::install())
			return false;
		return true;
	}

	/**
	 * @see Module::uninstall()
	 */
	public function uninstall()
	{
		if (!parent::uninstall())
			return false;
		return true;
	}
}