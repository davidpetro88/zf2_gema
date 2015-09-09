<?php
namespace SONUser\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select,
    Zend\Form\Element;


class Materia extends Form
{
    protected $users;
    protected $sessao;
    protected $statusMateria;

    public function __construct($name = null, array $users = null,  array $sessoes = null, array $status = null) {
        parent::__construct($name);

        $this->users = $users;
        $this->sessao = $sessoes;
        $this->statusMateria = $status;

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $this->add(array(
            'name' => 'titulo',
            'options' => array(
                'type' => 'Zend\Form\Element\Text',
                'label' => 'Titulo'
            ),
            'attributes' => array(
                'id' => 'titulo',
                'class' => 'form-control input-lg',
                'placeholder' => 'Entre com o titulo'
            )
        ));

        $this->add(array(
            'name' => 'url_materia',
            'options' => array(
                'type' => 'Zend\Form\Element\Text',
                'label' => 'Url Materia'
            ),
            'attributes' => array(
                'id' => 'url_materia',
                'class' => 'form-control input-lg',
                'placeholder' => 'Entre com a url'
            )
        ));


        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'autor',
            'attributes' =>  array(
               'id' => 'autor',
               'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Autor',
                'options' => $users,
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'sessao',
            'attributes' =>  array(
               'id' => 'sessoes',
               'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Sessão',
                'options' => $sessoes,
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status',
            'attributes' =>  array(
                'id' => 'status',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Status Matéria',
                'options' => $status,
            ),
        ));

        $this->add(array(
            'name' => 'conteudo',
            'attributes'=> array(
                'id'    => 'conteudo',
                'type'  => 'textarea',
                'class' => 'summernote'
            ),
            'options' => array(
                'label' => 'Conteúdo',
            )
        ));

//         $this->add(array(
//             'name' => 'submit',
//             'type' => 'Zend\Form\Element\Submit',
//             'attributes' => array(
//                 'value' => 'Salvar',
//                  'id' => "id-button-form",
//                 'class' => 'btn btn-large btn-success'
//             )
//         ));
    }
}

