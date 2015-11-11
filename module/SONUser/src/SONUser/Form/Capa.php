<?php
namespace SONUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Capa extends Form
{
    protected $capa;

    public function __construct($name = null, array $capa = null , array $materia = null, $capaPrincipal = null, $ativoSelected = null)
    {
        parent::__construct($name);
        $this->capa = $capa;
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
            'options' => array(
                'label' => 'Capa:',
                'value_options' => array( 0 => 'N', 1 => 'S')
            ),
            'attributes' => array(
                'id' => 'capa',
                'class' => 'form-control',
                'value' => $capaPrincipal
            )
        ));

        $this->add([
            'type' => 'Zend\Form\Element\Select',
            'name' => 'active',
            'options' => [
                'label' => 'Ativo',
                'value_options' => [
                    0 => 'N',
                    1 => 'S',
                ],
            ],
            'attributes' => [
                'class' => 'form-control',
                'value' => $ativoSelected, //set selected to '1'
            ],
        ]);



        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'usuario',
            'attributes' =>  array(
                'id' => 'usuario',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Usuário:',
                'options' => $capa,
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


    public function capaPrincipal ($param) {
        if ($param == 1) return array( '0' => 'N', '1' => 'S');
        return array( '0' => 'N', '1' => 'S');
    }



}