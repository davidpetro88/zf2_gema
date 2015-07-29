<?php

namespace SONUser\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService,
Zend\Authentication\Storage\Session as SessionStorage;

class MateriasController extends CrudController
{
    public function __construct()
    {
        $this->entity = 'SONUser\Entity\Materia';
        $this->service = 'SONUser\Service\Materia';
        $this->form = 'SONUser\Form\Materia';
        $this->controller = "materias";
        $this->route = "sonuser-materia";
    }

    public function newAction()
    {
        $form = $this->getServiceLocator()->get('SONUser\Form\Materia');
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
        $form = $this->getServiceLocator()->get('SONUser\Form\Materia');
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));

        if($this->params()->fromRoute('id',0))
            $form->setData($entity->toArray());

        if($request->isPost())
        {
            $form->setData($request->getPost());
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
        }

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repo = $em->getRepository('SONUser\Entity\Comentario');
        $comentarios = $repo->getListComentarioFromMateria ($this->params()->fromRoute('id',0));

        $entityArray = $entity->toArray();
        return new ViewModel(array( 'form'=> $form,
                                    'status' => $entityArray['status']->getId(),
                                    'user' => $this->getUserIdentity(),
                                    'comentarios' => $comentarios));
    }

    public function noticiasAction () {

    }

    private function getUserIdentity () {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage());
        if(is_null($auth->getIdentity())) return null;
        $dataUnserializeRole = unserialize(serialize($auth->getIdentity()->getRole()));
        return array('id' => $auth->getIdentity()->getId(),
                     'nome' => $auth->getIdentity()->getNome(),
                     'role_id' => $dataUnserializeRole->getId()
                     );
    }
}