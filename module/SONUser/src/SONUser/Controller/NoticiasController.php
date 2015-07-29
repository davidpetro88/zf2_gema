<?php
namespace SONUser\Controller;

use Zend\Mvc\Controller\AbstractActionController,
Zend\View\Model\ViewModel;

class NoticiasController extends CrudController
{
    public function __construct()
    {
        $this->entity = 'SONUser\Entity\Materia';
        $this->service = 'SONUser\Service\Materia';
        $this->form = 'SONUser\Form\Materia';
        $this->controller = "noticias";
        $this->route = "sonuser-public-list-materia";
    }

    public function editAction()
    {
        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));
        return new ViewModel(array('data'=>$entity));
    }

    public function artigoAction () {
        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->findByUrl($this->params()->fromRoute('id',0));
        return new ViewModel(array('data'=>$entity));
    }
}