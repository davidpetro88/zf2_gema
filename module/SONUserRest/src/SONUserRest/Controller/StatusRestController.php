<?php
namespace SONUserRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class StatusRestController extends AbstractRestfulController
{

    // Listar - GET
    public function getList()
    {
        $data = $this->getServiceLocator()->get('status-factory')->findArray();
        return new JsonModel(array('data'=>$data));
    }

    // Retornar o registro especifico - GET
    public function get($id)
    {
        $data = $this->getServiceLocator()->get('status-factory')->findByIdArray($id);
        return new JsonModel(array('data'=>$data));
    }

    // Insere registro - POST
    public function create($data)
    {
        $userService = $this->getServiceLocator()->get('SONUser\Service\Status');

        if($data)
        {
            $user = $userService->insert($data);
            if($user)
            {
                return new JsonModel(array('data'=>array('id'=>$user->getId(),'success'=>true)));
            }
            else
            {
                return new JsonModel(array('data'=>array('success'=>false)));
            }
        }
        else
            return new JsonModel(array('data'=>array('success'=>false)));
    }

    // alteracao - PUT
    public function update($id, $data)
    {
        $data['id'] = $id;
        $userService = $this->getServiceLocator()->get('SONUser\Service\Status');

        if($data)
        {
            $user = $userService->update($data);
            if($user)
            {
                return new JsonModel(array('data'=>array('id'=>$user->getId(),'success'=>true)));
            }
            else
            {
                return new JsonModel(array('data'=>array('success'=>false)));
            }
        }
        else
            return new JsonModel(array('data'=>array('success'=>false)));
    }

    // delete - DELETE
    public function delete($id)
    {
        $userService = $this->getServiceLocator()->get('SONUser\Service\Status');
        $res = $userService->delete($id);

        if($res)
        {
            return new JsonModel(array('data'=>array('success'=>true)));
        }
        else
            return new JsonModel(array('data'=>array('success'=>false)));
    }
}