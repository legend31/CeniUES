<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Record
 *
 * @ORM\Table(name="record", indexes={@ORM\Index(name="fk_Record_Nivel1_idx", columns={"Nivel_idNivel"}), @ORM\Index(name="fk_Record_RecordAlumno1_idx", columns={"RecordAlumno_idRecordAlumno"})})
 * @ORM\Entity
 */
class Record
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idRecord", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrecord;

    /**
     * @var integer
     *
     * @ORM\Column(name="esGraduado", type="integer", nullable=false)
     */
    private $esgraduado;

    /**
     * @var \Nivel
     *
     * @ORM\ManyToOne(targetEntity="Nivel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Nivel_idNivel", referencedColumnName="idNivel")
     * })
     */
    private $nivelnivel;

    /**
     * @var \Recordalumno
     *
     * @ORM\ManyToOne(targetEntity="Recordalumno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RecordAlumno_idRecordAlumno", referencedColumnName="idRecordAlumno")
     * })
     */
    private $recordalumnorecordalumno;



    /**
     * Get idrecord
     *
     * @return integer
     */
    public function getIdrecord()
    {
        return $this->idrecord;
    }

    /**
     * Set esgraduado
     *
     * @param integer $esgraduado
     *
     * @return Record
     */
    public function setEsgraduado($esgraduado)
    {
        $this->esgraduado = $esgraduado;

        return $this;
    }

    /**
     * Get esgraduado
     *
     * @return integer
     */
    public function getEsgraduado()
    {
        return $this->esgraduado;
    }

    /**
     * Set nivelnivel
     *
     * @param \AppBundle\Entity\Nivel $nivelnivel
     *
     * @return Record
     */
    public function setNivelnivel(\AppBundle\Entity\Nivel $nivelnivel = null)
    {
        $this->nivelnivel = $nivelnivel;

        return $this;
    }

    /**
     * Get nivelnivel
     *
     * @return \AppBundle\Entity\Nivel
     */
    public function getNivelnivel()
    {
        return $this->nivelnivel;
    }

    /**
     * Set recordalumnorecordalumno
     *
     * @param \AppBundle\Entity\Recordalumno $recordalumnorecordalumno
     *
     * @return Record
     */
    public function setRecordalumnorecordalumno(\AppBundle\Entity\Recordalumno $recordalumnorecordalumno = null)
    {
        $this->recordalumnorecordalumno = $recordalumnorecordalumno;

        return $this;
    }

    /**
     * Get recordalumnorecordalumno
     *
     * @return \AppBundle\Entity\Recordalumno
     */
    public function getRecordalumnorecordalumno()
    {
        return $this->recordalumnorecordalumno;
    }
}
