<?php

namespace SONUser\Form;

use Zend\Form\Form;

class Login  extends Form
{

    public function __construct($name = null, $options = array()) {
        parent::__construct('Login', $options);

        $this->setAttribute('method', 'post');

        $this->add(array('name' => 'email',
                         'options' => array(
                            'type' => 'Zend\Form\Element\Text',
                            'label' => 'E-mail:'
                         ),
                         'attributes' => array(
                            'id' => 'email',
                            'class' => 'form-control input-lg',
                            'placeholder' => 'Entre com o E-mail'
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

//         $this->add(array(
//             'name' => 'password',
//             'options' => array(
//                 'type' => 'Zend\Form\Element\Text',
//                 'label' => 'Password:'
//             ),
//             'attributes' => array(
//                 'id' => 'password',
//                 'class' => 'form-control input-lg',
//                 'placeholder' => 'Entre com a senha'
//             )
//         ));

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
