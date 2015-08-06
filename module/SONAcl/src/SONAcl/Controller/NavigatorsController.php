<?php
namespace SONAcl\Controller;

use SONBase\Controller\CrudController;
use Zend\View\Model\ViewModel;

class NavigatorsController extends CrudController
{

    public function __construct() {
        $this->entity = 'SONAcl\Entity\Navigator';
        $this->service = 'SONAcl\Service\Navigators';
        $this->form = 'SONAcl\Form\Navigators';
        $this->controller = 'navigators';
        $this->route = "sonacl-admin/default";
    }


    public function newAction()
    {
        $form = $this->getServiceLocator()->get('SONAcl\Form\Navigators');
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


}