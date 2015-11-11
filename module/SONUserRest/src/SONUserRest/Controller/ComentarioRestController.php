<?php
namespace SONUserRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use SONUserRest\Business\ComentariosBusiness as ComentariosBusiness;

class ComentarioRestController extends AbstractRestfulController
{

    // Listar - GET
    public function getList()
    {
        $comentarioBusiness = new ComentariosBusiness($this->getServiceLocator());
        $data = $comentarioBusiness->getList();
        return new JsonModel(array('data'=>$data));
    }

    // Retornar o registro especifico - GET
    public function get($id)
    {
        $comentarioBusiness = new ComentariosBusiness($this->getServiceLocator());
        $data = $comentarioBusiness->get($id)->toArray();
        return new JsonModel(array('data'=>$data));

    }

    // Insere registro - POST
    public function create($data)
    {
        if($data)
        {
            $comentarioBusiness = new ComentariosBusiness($this->getServiceLocator());
            $comentario = $comentarioBusiness->insert($data);
            if($comentario)
            {
                return new JsonModel(array('data'=>array('id'=>$comentario->getId(),'success'=>true)));
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
        $userService = $this->getServiceLocator()->get('SONUser\Service\Comentario');

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
        $userService = $this->getServiceLocator()->get('SONUser\Service\Comentario');
        $res = $userService->delete($id);

        if($res)
        {
            return new JsonModel(array('data'=>array('success'=>true)));
        }
        else
            return new JsonModel(array('data'=>array('success'=>false)));
    }
}