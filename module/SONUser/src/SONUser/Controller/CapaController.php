<?php
namespace SONUser\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class CapaController extends CrudController
{
    public function __construct()
    {
        $this->entity = 'SONUser\Entity\Capa';
        $this->service = 'SONUser\Service\Capa';
        $this->form = 'SONUser\Form\Capa';
        $this->controller = "capa";
        $this->route = "sonuser-capa";
    }

    public function newAction()
    {
        $form = $this->getServiceLocator()->get('SONUser\Form\Capa');
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

//     public function editAction()
//     {
//         $form = new $this->form();
//         $request = $this->getRequest();

//         $repository = $this->getEm()->getRepository($this->entity);
//         $entity = $repository->find($this->params()->fromRoute('id',0));
//         return new ViewModel(array('data'=>$entity));
//     }
}
