<?php

include_once _PS_MODULE_DIR_ . 'lexikotron/models/Glossary.php';

class AdminGlossaryController extends ModuleAdminController
{
    /**
     * @see ModuleAdminController::__construct()
     */
    public function __construct()
    {
        $this->table      = 'lexikotron';
        $this->className  = 'Glossary';
        $this->identifier = "id_lexikotron";
        $this->lang = true;
        $this->bootstrap  = true;

        $this->context = Context::getContext();

        parent::__construct();
    }

    /**
     * @see ModuleAdminController::initProcess()
     */
    public function initProcess()
    {
        $this->bulk_actions = array(
            'delete' => array(
                'text'    => $this->l('Delete selected'),
                'confirm' => $this->l('Delete selected items?'),
            ),
        );

        parent::initProcess();
    }

    /**
     * @see AdminController::renderList()
     */
    public function renderList()
    {
        $this->fields_list = array(
            'id_lexikotron' => array(
                'title' => '#',
            ),
            'name'          => array(
                'title' => $this->l('Texte'),
            ),
            'active'        => array(
                'title'  => $this->l('Valider'),
                'active' => 'status',
            ),
        );

        $this->actions = array('edit', 'delete');

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
            'legend'  => array(
                'title' => $this->l('Glossary'),
                //'image' => '../img/admin/cog.gif',
                'icon' => 'icon-plus-sign-alt'
            ),
            'input'   => array(
                array(
                    'type'  => 'text',
                    'lang'  => true,
                    'label' => $this->l('Name:'),
                    'name'  => 'name',
                ),
                array(
                    'type'         => 'textarea',
                    'label'        => $this->l('Description:'),
                    'name'         => 'description',
                    'lang'         => true,
                    'autoload_rte' => true,
                ),
                array(
                    'type'     => 'switch',
                    'label'    => $this->l('Enabled'),
                    'name'     => 'active',
                    'required' => true,
                    'class'    => 't',
                    'is_bool'  => true,
                    'values'   => array(
                        array(
                            'id'    => 'glossary_on',
                            'value' => 1,
                            'label' => $this->l('Yes'),
                        ),
                        array(
                            'id'    => 'glossary_off',
                            'value' => 0,
                            'label' => $this->l('No'),
                        ),
                    ),
                ),
            ),
            'submit'  => array(
                'title' => $this->l('Save'), // This is the button that saves the whole fieldset.
                'class' => 'btn btn-default pull-right'
            ),
        );

        if (!($obj = $this->loadObject(true))) {
            return;
        }

        return parent::renderForm();
    }
}
