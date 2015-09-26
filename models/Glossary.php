<?php

class Glossary extends ObjectModel
{
	public $id;
	public $name;
	public $description;

	public static $definition = array(
		'table' => 'lexikotron',
		'primary' => 'id',
		'multilang' => true,
		'fields' => array(
			'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
			'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
			'name' => array('type' => self::TYPE_STRING, 'lang' => true),
			'description' => array('type' => self::TYPE_HTML,	'lang' => true)
		)
	);
}