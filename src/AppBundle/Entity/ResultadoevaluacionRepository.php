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

    public function getresevaluaciones($carnet){
        $em = $this->getEntityManager();
        return $em->createQuery(
            'SELECT b.nombreevaluacion, a.nota FROM AppBundle:Resultadoevaluacion a
             JOIN a.evaluacionevaluacion b
             WHERE a.alumnoCarnetalumno = :carnet')
            ->setParameter('carnet',$carnet)->getResult();
    }

}

?>