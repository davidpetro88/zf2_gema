<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        $capaRepository = $this->getEm()->getRepository('SONUser\Entity\Capa');
        return new ViewModel( array ("capa" => $capaRepository->findOneRandom(),
                                     "subCapa" => $capaRepository->findListRandom()
                            ));
    }


    /**
     *
     * @return EntityManager
     */
    private function getEm()
    {
        if(null === $this->em)
            $this->em = $this->getServiceLocator ()->get ('Doctrine\ORM\EntityManager');

        return $this->em;
    }
}
