<?php

class Glossary extends ObjectModel
{
    public $id;
    public $active;
    public $name;
    public $description;
    public $date_add;
    public $date_upd;

    public static $definition = array(
        'table'     => 'lexikotron',
        'primary'   => 'id_lexikotron',
        'multilang' => true,
        'fields'    => array(
            'active'      => array('type' => self::TYPE_BOOL),
            'name'        => array('type' => self::TYPE_STRING, 'lang' => true),
            'description' => array('type' => self::TYPE_HTML, 'lang' => true),
            'date_add'    => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
            'date_upd'    => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
        ),
    );

    /**
     * Get all available glossaries
     *
     * @param integer $id_lang Language id
     * @param array $criteria Criterias for where clause
     * @param integer $start Start number
     * @param integer $limit Number of glossaries to return
     * @param string $order_by Field for ordering
     * @param string $order_way Way for ordering (ASC or DESC)
     * @param boolean $only_active Returns only active glossaries if TRUE
     * @param Context|null $context
     *
     * @return array list of glossaries
     */
    public static function getGlossaries(
        $id_lang,
        $criteria = array(),
        $start = null,
        $limit = null,
        $order_by = null,
        $order_way = null,
        $only_active = false,
        Context $context = null
    ) {
        $where = '';

        if (!$context) {
            $context = Context::getContext();
        }

        if ($order_by !== null) {
            if (!Validate::isOrderBy($order_by) || !Validate::isOrderWay($order_way)) {
                die(Tools::displayError());
            }

            if ($order_by == 'id') {
                $order_by_prefix = 'l';
            } else {
                $order_by_prefix = 'll';
            }

            if (strpos($order_by, '.') > 0) {
                $order_by        = explode('.', $order_by);
                $order_by_prefix = $order_by[0];
                $order_by        = $order_by[1];
            }
        }

        if (isset($criteria['k'])) {
            $where .= " AND ll.name LIKE '" . pSQL($criteria['k']) . "%' ";
        }

        $sql = 'SELECT l.*, ll.*
                FROM `' . _DB_PREFIX_ . 'lexikotron` l
                LEFT JOIN `' . _DB_PREFIX_ . 'lexikotron_lang` ll ON (l.`id_lexikotron` = ll.`id_lexikotron`)
                WHERE ll.`id_lang` = ' . (int) $id_lang .
                    ($only_active ? ' AND l.`active` = 1' : '') . '
                    ' . $where . '
                    ' . ($order_by != null ? ('ORDER BY ' . (isset($order_by_prefix) ? pSQL($order_by_prefix) . '.' : '') . '`' . pSQL($order_by) . '` ' . pSQL($order_way)) : '') .
                    ($limit > 0 ? ' LIMIT ' . (int) $start . ',' . (int) $limit : '');

        $rows = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        return $rows;
    }
}
