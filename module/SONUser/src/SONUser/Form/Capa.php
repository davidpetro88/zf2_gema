<?php
namespace SONUser\Form;

use Zend\Form\Form,
Zend\Form\Element\Select;

class Capa extends Form
{
    protected $users;

    public function __construct($name = null, array $users = null , array $materia = null) {
        parent::__construct($name);

        $this->users = $users;
        $this->setAttribute('method', 'post');
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'materia',
            'attributes' =>  array(
                'id' => 'materia',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Materia:',
                'options' => $materia,
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'capa',
            'attributes' =>  array(
                'id' => 'capa',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Capa:',
                'options' => array( '0' => 'N',
                    '1' => 'S',
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ativo',
            'attributes' =>  array(
                'id' => 'ativo',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Ativo:',
                'options' => array ( '1' => 'S',
                                     '0' => 'N',
                                   ),
            ),
        ));



        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'usuario',
            'attributes' =>  array(
                'id' => 'usuario',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Usuário:',
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