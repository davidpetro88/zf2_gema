<?php

namespace SONAcl\Form;

use Zend\Form\Form;

class Role extends Form {

    protected $parent;

    public function __construct($name = null, array $parent = null) {
        parent::__construct('roles');
        $this->parent  = $parent;

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

        $allParent = array_merge(array(0=>'Nenhum'),$this->parent);
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'parent',
            'attributes' =>  array(
                'id' => 'parent',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Herda:',
                'options' => $allParent,
            ),
        ));

        $isAdmin = new \Zend\Form\Element\Checkbox("isAdmin");
        $isAdmin->setLabel("Admin?: ");
        $this->add($isAdmin);

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