<?php

namespace SONAcl\Controller;

use SONBase\Controller\CrudController;
use Zend\View\Model\ViewModel;

class DropdownController extends CrudController
{
    public function __construct() {
        $this->entity = 'SONAcl\Entity\Dropdown';
        $this->service = 'SONAcl\Service\Dropdown';
        $this->form = 'SONAcl\Form\Dropdown';
        $this->controller = "dropdown";
        $this->route = "sonacl-admin/default";
    }
}