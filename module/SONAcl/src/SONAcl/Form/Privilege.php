<?php

namespace SONAcl\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select;

class Privilege extends Form {

    protected $roles;
    protected $resources;

    public function __construct($name = null, array $roles = null, array $resources = null) {
        parent::__construct($name);
        $this->roles = $roles;
        $this->resources = $resources;

        $this->setAttribute('method', 'post');
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $this->add(array(
            'name' => 'nome',
            'options' => array(
                'type' => 'Zend\Form\Element\Text',
                'label' => 'Nome:'
            ),
            'attributes' => array(
                'id' => 'nome',
                'class' => 'form-control input-lg',
                'placeholder' => 'Entre com o nome'
            )
        ));

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
            'name' => 'resource',
            'attributes' =>  array(
                'id' => 'resource',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Resource:',
                'options' => $resources,
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