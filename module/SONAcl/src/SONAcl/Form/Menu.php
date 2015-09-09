<?php

namespace SONAcl\Form;

use Zend\Form\Form;

class Menu extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('menu');

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
            'name' => 'url',
            'options' => array(
                'type' => 'Zend\Form\Element\Text',
                'label' => 'Url:'
            ),
            'attributes' => array(
                'id' => 'url',
                'class' => 'form-control input-lg',
                'placeholder' => 'Entre com o nome'
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