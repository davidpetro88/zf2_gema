<?php

namespace SONUser\Form;

use Zend\Form\Form;

class User  extends Form
{
    public function __construct($name = null, array  $options = null, array $roles = null, $roleSelected = null)
    {
        parent::__construct('user');

        $this->setInputFilter(new UserFilter());
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
                'placeholder' => 'Entre com o nome'
            )
        ));

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'type' => 'Zend\Form\Element\Text',
                'label' => 'Email:'
            ),
            'attributes' => array(
                'id' => 'nome',
                'class' => 'form-control input-lg',
                'placeholder' => 'Entre com o E-mail'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'role',
            'options' => array(
                'label' => 'Role:',
                'value_options' => $roles
            ),
            'attributes' => array(
                'id' => 'role',
                'class' => 'form-control',
                'value' => $roleSelected
            )
        ));

        $this->add(array('name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'id' => 'password',
                'autocomplete' => 'off',
                'class' => 'form-control input-lg',
                'placeholder' => 'Entre com a senha',
            ),
            'options' => array(
                'label' => 'Senha:',
            ),
        ));

        $this->add(array('name' => 'confirmation',
            'attributes' => array(
                'type'  => 'password',
                'id' => 'confirmation',
                'autocomplete' => 'off',
                'class' => 'form-control input-lg',
                'placeholder' => 'Redigite a senha',
            ),
            'options' => array(
                'label' => 'Redigite:',
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