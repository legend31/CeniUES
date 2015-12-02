<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ModuloRepository
 */

class ModuloRepository extends EntityRepository{

    public function modulosxfecha($fechanow){
        $em=$this->getEntityManager();
        return $em->createQuery(
            'SELECT m FROM AppBundle:Modulo m WHERE m.fechainicio > :fecha ORDER BY m.nombremodulo ASC'
        )->setParameter('fecha',$fechanow)->getResult();
    }

    public function buscarmodulos1($fecha,$nombre){
        $em=$this->getEntityManager();
        return $em->createQuery(
            'SELECT m FROM AppBundle:Modulo m WHERE m.nombremodulo = :nombre OR m.fechainicio = :fecha OR m.fechafin > :fecha'
        )->setParameter('nombre',$nombre)->setParameter('fecha',$fecha)->getResult();
    }
}