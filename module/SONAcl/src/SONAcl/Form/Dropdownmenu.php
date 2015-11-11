<?php

namespace SONAcl\Form;

use Zend\Form\Form;

class Dropdownmenu extends Form
{
    public function __construct($name = null, array $dropdown = null, array $menu = null,$menuSelected = null,  $dropDownSelected = null)
    {
        parent::__construct('dropdownmenu');

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'dropdowns',
            'options' => array(
                'label' => 'Dropdown:',
                'value_options' => $dropdown
            ),
            'attributes' => array(
                'id' => 'dropdown',
                'class' => 'form-control',
                'value' => $dropDownSelected
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'menus',
            'options' => array(
                'label' => 'Menu:',
                'value_options' => $menu
            ),
            'attributes' => array(
                'id' => 'menu',
                'class' => 'form-control',
                'value' => $menuSelected
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'id' => "id-button-form",
                'class' => 'btn btn-large btn-success'
            )
        ));
    }
}