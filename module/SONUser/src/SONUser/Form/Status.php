<?php

namespace SONUser\Form;

use Zend\Form\Form;

class Status extends Form
{

    public function  __construct($name = null,array $status = null, $nexSatus = null, $backSatus = null) {
        parent::__construct($name);

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $this->add(array(
            'name' => 'nome',
            'options' => array(
                'type' => 'Zend\Form\Element\Text',
                'label' => 'Nome'
            ),
            'attributes' => array(
                'id' => 'nome',
                'class' => 'form-control input-lg',
                'placeholder' => 'Entre com o titulo'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'nextStatus',
            'attributes' =>  array(
                'id' => 'nextStatus',
                'class' => 'form-control',
                'value' => $nexSatus
            ),
            'options' => array(
                'label' => 'Próximo Status',
                'options' => $status,
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'backStatus',
            'attributes' =>  array(
                'id' => 'backStatus',
                'class' => 'form-control',
                'value' => $backSatus
            ),
            'options' => array(
                'label' => 'Voltar Status',
                'options' => $status,
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