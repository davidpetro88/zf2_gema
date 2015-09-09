<?php
namespace SONUser\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement as BaseFormElement;

class FormElement extends BaseFormElement
{

    public function render(ElementInterface $element)
    {
        $req = '';
        if ($element->getOption('required')) {
            $req = 'required';
        }

        return sprintf('<tr><td>%s</td><td>%s</td>  </tr>', $element->getAttributes(), parent::render($element));
    }
}