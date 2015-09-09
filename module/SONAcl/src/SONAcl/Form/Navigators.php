<?php
namespace SONAcl\Form;

use Zend\Form\Form,
Zend\Form\Element\Select;

class Navigators  extends Form
{
    public function __construct($name = null, array $roles = null, array $dropdown = null) {
        parent::__construct($name);

        $this->setAttribute('method', 'post');
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);


        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'role',
            'attributes' =>  array(
                'id' => 'role',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Role:',
                'options' => $roles,
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'dropdown',
            'attributes' =>  array(
                'id' => 'dropdown',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Dropdown:',
                'options' => $dropdown,
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