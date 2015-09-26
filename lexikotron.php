<?php

/*
*  @author Mario Johnathan <xanou.dev@gmail.com>
*/

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
		if (
			!parent::install()
			&& !$this->createTables();
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
			&& !$this->deleteTables()
		)
			return false;
		return true;
	}

	/**
	 * deletes tables
	 */
	protected function deleteTables()
	{
		return Db::getInstance()->execute('
			DROP TABLE IF EXISTS `'._DB_PREFIX_.'lexikotron`;
		');
	}
}