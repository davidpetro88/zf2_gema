<?php

namespace SONUser\Form;

use Zend\Form\Form;

class User  extends Form
{

    public function __construct($name = null, $options = array()) {
        parent::__construct('user', $options);

        $this->setInputFilter(new UserFilter());
        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

//         $nome = new \Zend\Form\Element\Text("nome");
//         $nome->setLabel("Nome: ")
//                 ->setAttribute('placeholder','Entre com o nome');
//         $this->add($nome);

//         $email = new \Zend\Form\Element\Text("email");
//         $email->setLabel("Email: ")
//         ->setAttribute('placeholder','Entre com o Email');
//         $this->add($email);

//         $password = new \Zend\Form\Element\Password("password");
//         $password->setLabel("Password: ")
//         ->setAttribute('placeholder','Entre com a senha');
//         $this->add($password);

//         $confirmation = new \Zend\Form\Element\Password("confirmation");
//         $confirmation->setLabel("Redigite: ")
//         ->setAttribute('placeholder','Redigite a senha');
//         $this->add($confirmation);

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
            'name' => 'password',
            'options' => array(
                'type' => 'Zend\Form\Element\Text',
                'label' => 'Password:'
            ),
            'attributes' => array(
                'id' => 'nome',
                'class' => 'form-control input-lg',
                'placeholder' => 'Entre com a senha'
            )
        ));

        $this->add(array(
            'name' => 'confirmation',
            'options' => array(
                'type' => 'Zend\Form\Element\Text',
                'label' => 'Redigite:'
            ),
            'attributes' => array(
                'id' => 'confirmation',
                'class' => 'form-control input-lg',
                'placeholder' => 'Redigite a senha'
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
