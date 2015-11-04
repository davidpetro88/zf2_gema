<?php

namespace SONUser\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class SessoesController extends CrudController
{
    public function __construct()
    {
        $this->entity = "SONUser\\Entity\\Sessao";
        $this->service = "SONUser\\Service\\Sessao";
        $this->form = "SONUser\\Form\\Sessao";
        $this->controller = "sessoes";
        $this->route = "sonuser-sessao";
    }

    public function newAction()
    {
        $form = $this->getServiceLocator()->get('SONUser\Form\Sessao');
        $request = $this->getRequest();

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->insert($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }

        return new ViewModel(array('form'=>$form));
    }

    public function editAction()
    {
        $form = $this->getServiceLocator()->get('SONUser\Form\Sessao');
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));

        if($this->params()->fromRoute('id',0))
            $form->setData($entity->toArray());

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }

        return new ViewModel(array('form'=>$form));
    }
}