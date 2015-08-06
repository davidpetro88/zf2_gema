<?php

namespace SONAcl\Controller;

use SONBase\Controller\CrudController;
use Zend\View\Model\ViewModel;

class MenuController extends CrudController
{

    public function __construct() {
        $this->entity = 'SONAcl\Entity\Menu';
        $this->service = 'SONAcl\Service\Menu';
        $this->form = 'SONAcl\Form\Menu';
        $this->controller = "menu";
        $this->route = "sonacl-admin/default";
    }

}
