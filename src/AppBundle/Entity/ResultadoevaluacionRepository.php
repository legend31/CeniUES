<?php
namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ResultadoevaluacionRepository
 */

class ResultadoevaluacionRepository extends EntityRepository{

    public function getsnotasalum($alumn){
        $em = $this->getEntityManager();
        return $em->createQuery();
    }

    public function getsalumnonivel($niv, $horario){
        $em = $this->getEntityManager();
        return $em->createQuery();
    }
}

?>