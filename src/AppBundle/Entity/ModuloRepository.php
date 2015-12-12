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
            'SELECT m.nombremodulo FROM AppBundle:Modulo m WHERE m.fechainicio > :fecha ORDER BY m.nombremodulo ASC'
        )->setParameter('fecha',$fechanow)->getResult();
    }

    public function buscarmodulos1($fechai,$fechaf,$nombre){
        $em=$this->getEntityManager();
        return $em->createQuery(
            'SELECT m FROM AppBundle:Modulo m WHERE m.nombremodulo = :nombre AND m.fechainicio <= :fechai AND m.fechafin >= :fechaf'
        )->setParameter('nombre',$nombre)->setParameter('fechai',$fechai)->setParameter('fechaf',$fechaf)->getOneOrNullResult();
    }
}