<?php
namespace SONUser\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select;

class Sessao extends Form
{
    protected $users;

    public function __construct($name = null, array $users = null) {
        parent::__construct($name);

        $this->users = $users;
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
                'id' => 'confirmation',
                'class' => 'form-control input-lg',
                'placeholder' => 'Digite o nome da matéria'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Gerente',
            'attributes' =>  array(
                'id' => 'Gerente',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Gerente:',
                'options' => $users,
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