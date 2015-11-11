<?php
namespace SONAcl\Form;

use Zend\Form\Form;

class Navigators  extends Form
{
    public function __construct($name = null, array $rolesList = null, array $dropdownList = null, $roleSelected = null,  $dropDownSelected = null) {
        parent::__construct($name);

        $this->setAttribute('method', 'post');
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'roles',
            'options' => array(
                'label' => 'Role:',
                'value_options' => $rolesList
            ),
            'attributes' => array(
                'id' => 'roles',
                'class' => 'form-control',
                'value' => $roleSelected
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'dropdowns',
            'options' => array(
                'label' => 'DropDown:',
                'value_options' => $dropdownList
            ),
            'attributes' => array(
                'class' => 'form-control',
                'value' => $dropDownSelected //set selected to '1'
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