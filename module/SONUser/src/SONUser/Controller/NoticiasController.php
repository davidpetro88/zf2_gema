<?php
namespace SONUser\Controller;

use Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator,
Zend\Paginator\Adapter\ArrayAdapter;


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

    public function categoriaAction ()
    {
        $getIdSessao = $this->getEm()
                            ->getRepository('SONUser\Entity\Sessao')
                            ->findSessaoByName( $this->params()->fromRoute('id',0) );

        if(empty($getIdSessao)) throw new \Exception("Categoria não encontrada", "0002",null);

        $list = $this->getEm()
                     ->getRepository($this->entity)
                     ->findByIdSessao($getIdSessao->getId() );
        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
                  ->setDefaultItemCountPerPage(10);

        return new ViewModel(array('data'=>$paginator,'page'=>$page));
    }
}