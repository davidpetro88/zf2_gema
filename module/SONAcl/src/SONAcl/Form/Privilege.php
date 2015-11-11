<?php

namespace SONAcl\Form;

use Zend\Form\Form;

class Privilege extends Form {

    protected $roles;
    protected $resources;

    public function __construct($name = null, array $roles = null, array $resources = null, $roleSelected = null, $resourceSelected = null) {
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
            'name' => 'roles',
            'options' => array(
                'label' => 'Role:',
                'value_options' => $roles
            ),
            'attributes' => array(
                'class' => 'form-control',
                'value' => $roleSelected //set selected to '1'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'resources',
            'options' => array(
                'label' => 'Resource:',
                'value_options' => $resources
            ),
            'attributes' => array(
                'class' => 'form-control',
                'value' => $resourceSelected //set selected to '1'
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