<?php

namespace SONAcl\Form;

use Zend\Form\Form;

class Dropdownmenu extends Form
{
    public function __construct($name = null, array $dropdown = null, array $menu = null)
    {
        parent::__construct('dropdownmenu');

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'dropdown',
            'attributes' =>  array(
                'id' => 'role',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Dropdown:',
                'options' => $dropdown,
            ),
        ));


        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'menu',
            'attributes' =>  array(
                'id' => 'menu',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Menu:',
                'options' => $menu,
            ),
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