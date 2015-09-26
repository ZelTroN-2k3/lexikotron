<?php

class Glossary extends ObjectModel
{
	public $id;
	public $active;
	public $name;
	public $description;
	public $date_add;
	public $date_edit;

	public static $definition = array(
		'table' => 'lexikotron',
		'primary' => 'id',
		'multilang' => true,
		'fields' => array(
			'active' =>	array('type' => self::TYPE_BOOL, 'shop' => true, 'validate' => 'isBool'),
			'name' => array('type' => self::TYPE_STRING, 'lang' => true),
			'description' => array('type' => self::TYPE_HTML,	'lang' => true)
			'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
			'date_edit' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
		)
	);
}