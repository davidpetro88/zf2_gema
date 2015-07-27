<?php
namespace SONUser\Form\View\Helper;

use Zend\Form\View\Helper\FormCollection;

class FieldCollection extends FormCollection
{
    protected $defaultElementHelper = 'fieldRow';
//     public function render(ElementInterface $element)
//     {
//         print_r($element);
//         return sprintf('<div  class="">%s</div><br />', parent::render($element));
//     }
}
