<?php
namespace SONUser\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\View\Helper\AbstractHelper;

class FormLabel extends AbstractHelper
{

    public function __invoke(ElementInterface $element = null, $labelContent = null, $position = null)
    {
        $labelContent = $element->getLabel();
        // Implement all default lines of Zend\Form\View\Helper\FormLabel

        // Set $required to a default of true | existing elements required-value
        $required = ($element->hasAttribute('required') ? $element->getAttribute('required') : true);

        if (true === $required && ($labelContent != '' || $labelContent != null || $labelContent != false)) {
            $labelContent = sprintf('<label for="inputStandard" class="col-lg-2 control-label">%s</label>', $labelContent);
        } elseif (false === $required && ($labelContent != '' || $labelContent != null || $labelContent != false)) {
            $labelContent = $labelContent;
        }
        return $labelContent;
    }
}
