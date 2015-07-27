<?php
namespace SONUserRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ComentarioRestController extends AbstractRestfulController
{

    // Listar - GET
    public function getList()
    {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $comentarioRepository = $em->getRepository("SONUser\Entity\Comentario")->getQuantityComentariosByMateria(1);

        $ct = "m relatório de investigação inédito a que o Jornal Nacional teve acesso mostra que a Petrobras ficou no prejuízo num contrato com a Braskem, empresa do Grupo Odebrecht em sociedade com a estatal.";
        $autor = "David ";

        $idMateria = isset($comentarioRepository) ? count($comentarioRepository) : 0;
        $conteudoToSave = $this->validateHtmlToSave($idMateria , $ct, $autor );
        //isset($data)
        $data = array();
        $data['autor'] = 1;
        $data['idMateria'] = 1;
        $data['comentario'] = $conteudoToSave;

        $comentario = $this->getServiceLocator()->get("SONUser\Service\Comentario");
        $comentario->insert($data);


print "<pre>"; print_r($conteudoToSave);

die();
        $data = $repo->findArray();

        return new JsonModel(array('data'=>$data));

    }

    // Retornar o registro especifico - GET
    public function get($id)
    {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $repo = $em->getRepository("SONUser\Entity\User");

        $data = $repo->find($id)->toArray();

        return new JsonModel(array('data'=>$data));

    }

    // Insere registro - POST
    public function create($data)
    {
        if($data)
        {
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $comentarioQuantity = $em->getRepository("SONUser\Entity\Comentario")->getQuantityComentariosByMateria($data['idMateria']);
            $conteudoToSave = $this->validateHtmlToSave($comentarioQuantity , $data['comentario'], $data['nomeCliente'] );
            $data['comentario'] = $conteudoToSave;

            $comentario = $this->getServiceLocator()->get("SONUser\Service\Comentario")->insert($data);

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
        $userService = $this->getServiceLocator()->get("SONUser\Service\User");

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
        $userService = $this->getServiceLocator()->get("SONUser\Service\User");
        $res = $userService->delete($id);

        if($res)
        {
            return new JsonModel(array('data'=>array('success'=>true)));
        }
        else
            return new JsonModel(array('data'=>array('success'=>false)));
    }



    private function getHtmlToSave ($htmlToSave, $conteudo , $autor) {

        if($htmlToSave == null) {

        } else {


        }

    }

    private function htmlTimeLine( $autor, $conteudo ) {
        return "<li>
                  <div class='timeline-badge info'><i class='glyphicon glyphicon-floppy-disk'></i></div>
                  <div class='timeline-panel'>
                    <div class='timeline-heading'>
                      <h4 class='timeline-title'>".$autor."</h4>
                    </div>
                    <div class='timeline-body'>
                      <p>". $conteudo. "</p>
                      <hr>
                    </div>
                  </div>
                </li>";
    }

    private function htmlTimeLineInverted( $autor, $conteudo ) {
        return "<li class='timeline-inverted'>
                  <div class='timeline-badge success'><i class='glyphicon glyphicon-thumbs-up'></i></div>
                  <div class='timeline-panel'>
                    <div class='timeline-heading'>
                      <h4 class='timeline-title'>".$autor."</h4>
                    </div>
                    <div class='timeline-body'>
                      <p>". $conteudo. "</p>
                    </div>
                  </div>
                 </li>";


    }

    private function validateHtmlToSave($val, $conteudo, $autor) {
        if($val % 2 == 0) return $this->htmlTimeLine( $autor, $conteudo );
        return  $this->htmlTimeLineInverted( $autor, $conteudo );
    }
}
