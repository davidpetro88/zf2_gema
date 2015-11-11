<?php
namespace SONUser\Service;

use SONBase\Service\AbstractService;
use Zend\Stdlib\Hydrator;
use Zend\Authentication\AuthenticationService,
Zend\Authentication\Storage\Session as SessionStorage;

class Materia extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'SONUser\Entity\Materia';
    }

    /* @var $entity \SONUser\Entity\Materia */
    public function insert(array $data)
    {
        $entity = new $this->entity($data);
        $urlMateria = $data['url_materia'] != null ? $data['url_materia'] : $data['titulo'];
        $entity->setUrlMateria($this->preparaUrl(null, $urlMateria));
        $entity->setAutor($this->em->getReference('SONUser\Entity\User',$data["autor"]));
        $entity->setSessao($this->em->getReference('SONUser\Entity\Sessao',$data["sessao"]));
        $entity->setStatus($this->em->getReference('SONUser\Entity\Status',$data["status"]));

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    /* @var $entity \SONUser\Entity\Materia */
    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);
        if($data['status'] == 2) {
            $entity->setRevisor($this->em->getReference('SONUser\Entity\User',$this->getUserIdentity ()));
        } else if ($data['status'] == 4) {
            $entity->setPublicador($this->em->getReference('SONUser\Entity\User',$this->getUserIdentity ()));
        }
        $entity->setAutor($this->em->getReference('SONUser\Entity\User',$data["autor"]));
        $entity->setSessao($this->em->getReference('SONUser\Entity\Sessao',$data["sessao"]));
        $entity->setStatus($this->em->getReference('SONUser\Entity\Status',$data["status"]));
        $urlMateria = $data['url_materia'] != null ? $data['url_materia'] : $data['titulo'];
        $entity->setUrlMateria($this->preparaUrl($data['id'], $urlMateria));
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    private function getUserIdentity () {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage());
        if(is_null($auth->getIdentity())) return null;
        return $auth->getIdentity()->getId();
    }

    private function preparaUrl($id = null, $urlString) {
        $urlMateria = $this->removeCharacter($this->removeAcentuacao($urlString));
        $repoMateria = $this->em->getRepository('SONUser\Entity\Materia');
        $validateIsRegistered = $repoMateria->validateIsRegistered($urlMateria);
        if(empty($validateIsRegistered)) return $urlMateria;
        if(!empty($id)) if ($id == $validateIsRegistered->getId()) return $urlMateria;
        if (!empty($repoMateria->getNextId ())) return $urlMateria."-".$repoMateria->getNextId ();
        throw new \Exception("Falha no processamento da requisição", "0001", null);
    }

    private function removeCharacter($string) {
        $from = array('?','!','.',':',',','/','\\','+','=','¨','"',"'",'@','#','$','%','&','*','(',')');
        return trim(str_replace($from, "", $string));
    }

    private function removeAcentuacao($string) {
        $string = trim($string);
        $string = preg_replace("/[áàâãä]/", "a", $string);
        $string = preg_replace("/[ÁÀÂÃÄ]/", "A", $string);
        $string = preg_replace("/[éèê]/", "e", $string);
        $string = preg_replace("/[ÉÈÊ]/", "E", $string);
        $string = preg_replace("/[íì]/", "i", $string);
        $string = preg_replace("/[ÍÌ]/", "I", $string);
        $string = preg_replace("/[óòôõö]/", "o", $string);
        $string = preg_replace("/[ÓÒÔÕÖ]/", "O", $string);
        $string = preg_replace("/[úùü]/", "u", $string);
        $string = preg_replace("/[ÚÙÜ]/", "U", $string);
        $string = preg_replace("/ç/", "c", $string);
        $string = preg_replace("/Ç/", "C", $string);
        $string = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", "", $string);
        $string = preg_replace("/ /", "-", $string);
        return $string;
    }
}