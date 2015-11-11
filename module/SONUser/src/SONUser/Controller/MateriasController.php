<?php

namespace SONUser\Controller;

use Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService,
Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Paginator\Paginator,
Zend\Paginator\Adapter\ArrayAdapter;

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

    public function searchAction()
    {
        $tituloSearch = $this->params()->fromRoute('id',0);
        $filtroData = $this->params()->fromRoute('data',0);
        $filtroStatus = $this->params()->fromRoute('status',0);

        $list = $this->getEm()->getRepository($this->entity)
                              ->findMateriaByFilters( $tituloSearch , $filtroData, $filtroStatus );
        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
        $listStatus = $this->getEm()->getRepository('SONUser\Entity\Status')->fetchPairs();
        return new ViewModel(array('data'=>$paginator,
                                   'page'=>$page,
                                   'listStatus' => $listStatus,
                                   'filtroStatusSelected' => $filtroStatus,
                                   'listData'=> array (1 => "CRESCENTE", 2 => "DECRESCEMTE"),
                                   'dataSelected' => $filtroData
                             ));
    }

    public function indexAction()
    {
        $list = $this->getEm()->getRepository($this->entity)->findAll();
        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
        $listStatus = $this->getEm()->getRepository('SONUser\Entity\Status')->fetchPairs();

        return new ViewModel(array('data'=>$paginator,
                                   'page'=>$page,
                                   'listStatus' => $listStatus,
                                   'filtroStatusSelected' => 0,
                                   'listData'=> array (1 => "CRESCENTE", 2 => "DECRESCEMTE"),
                                   'dataSelected' => 0
                              ));
    }

    private function getUserIdentity ()
    {
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