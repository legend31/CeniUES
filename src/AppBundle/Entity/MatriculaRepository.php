<?php

namespace AppBundle\Entity;

/**
 * MatriculaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MatriculaRepository extends \Doctrine\ORM\EntityRepository
{
    public function matriculasOrdenadas($carnet)
    {
        return $this->getEntityManager()->createQuery(
            'SELECT m FROM AppBundle:Matricula m WHERE m.alumnoCarnetalumno = :carnet ORDER BY m.nivelnivel ASC'
        )
            ->setParameter('carnet',$carnet )
            ->getResult();
    }
    public function matriculasActivas($carnet)
    {
        return $this->getEntityManager()->createQuery(
            'SELECT m FROM AppBundle:Matricula m WHERE m.alumnoCarnetalumno = :carnet AND m.esactivo = :activo'
        )
        ->setParameter('carnet',$carnet )
        ->setParameter('activo',1)
        ->getSingleResult();
    }
    public function fechaReciente($carnet)
    {
        return $this->getEntityManager()->createQuery(
            'SELECT MAX (m.fechamatricula) FROM AppBundle:Matricula m WHERE m.alumnoCarnetalumno = :carnet'
        )
            ->setParameter('carnet',$carnet)
            ->getSingleResult();
    }
    public function matriculasReciente($fecha)
    {
        return $this->getEntityManager()->createQuery(
            'SELECT m FROM AppBundle:Matricula m WHERE m.fechamatricula = :fecha'
        )
            ->setParameter('fecha',$fecha )
            ->getSingleResult();
    }
    public function alumnosmMatriculados()
    {
        return $this->getEntityManager()->createQuery(
            'SELECT m FROM AppBundle:Matricula m WHERE m.esactivo = :activo ORDER BY m.nivelnivel ASC '
        )
            ->setParameter('activo',1 )
            ->getResult();
    }
    public function numeroMatriculados()
    {
        //query = $em->createQuery('SELECT COUNT (DISTINCT ad.alumnoCarnetalumn) FROM AppBundle:Matricula');
        return $this->getEntityManager()->createQuery(
            'SELECT COUNT (DISTINCT ad.alumnoCarnetalumno) FROM AppBundle:Matricula ad'
        )
            ->getSingleScalarResult();
    }
    public function numeroActivos()
    {
        return $this->getEntityManager()->createQuery(
            'SELECT COUNT(ad.alumnoCarnetalumno)FROM AppBundle:Matricula ad WHERE ad.esactivo = :activo'
        )
            ->setParameter('activo',1 )
            ->getSingleScalarResult();
    }

    //FUNCION PARA OBTENER EL LISTADO DE ALUMNO INSCRITOS EN DIF. NIVELES Y CLASES
    public function listadoAlumnos($nivel, $horario){
        $em = $this->getEntityManager();
        /*return $em->createQuery(
            'SELECT CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(b.primernombrealumno," "),b.segundonombrealumno)," "),b.primerapellidoalumno)," "),b.segundoapellidoalumno)AS nombre
             FROM AppBundle:Matricula a
             INNER JOIN a.alumnoCarnetalumno b
             INNER JOIN a.nivelnivel c
             INNER JOIN AppBundle:Clase d WITH d.nivelnivel c
             WHERE c.nombrenivel = :nivel AND d.horario = :horario')->setParameter("nivel",$nivel)->setParameter("horario",$horario)->getResult();*/
        return $em->createQuery(
            "SELECT CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(CONCAT(b.primernombrealumno,' '),b.segundonombrealumno),' '),b.primerapellidoalumno),' '),b.segundoapellidoalumno) AS nombre,
             b.carnetalumno
             FROM AppBundle:Matricula a
             JOIN a.alumnoCarnetalumno b
             JOIN a.nivelnivel c
             JOIN AppBundle:Clase d WITH d.nivelnivel=c
             WHERE c.idnivel = :nivel AND d.horario = :horario")->setParameter("nivel",$nivel)->setParameter("horario",$horario)->getResult();
    }

}
