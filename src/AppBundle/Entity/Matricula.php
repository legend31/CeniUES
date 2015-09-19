<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matricula
 *
 * @ORM\Table(name="matricula", indexes={@ORM\Index(name="fk_Matricula_Nivel1_idx", columns={"Nivel_idNivel"})})
 * @ORM\Entity
 */
class Matricula
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idMatricula", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmatricula;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaMatricula", type="date", nullable=false)
     */
    private $fechamatricula;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroRecibo", type="string", length=45, nullable=false)
     */
    private $numerorecibo;

    /**
     * @var integer
     *
     * @ORM\Column(name="esActivo", type="integer", nullable=false)
     */
    private $esactivo;

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
     * Get idmatricula
     *
     * @return integer
     */
    public function getIdmatricula()
    {
        return $this->idmatricula;
    }

    /**
     * Set fechamatricula
     *
     * @param \DateTime $fechamatricula
     *
     * @return Matricula
     */
    public function setFechamatricula($fechamatricula)
    {
        $this->fechamatricula = $fechamatricula;

        return $this;
    }

    /**
     * Get fechamatricula
     *
     * @return \DateTime
     */
    public function getFechamatricula()
    {
        return $this->fechamatricula;
    }

    /**
     * Set numerorecibo
     *
     * @param string $numerorecibo
     *
     * @return Matricula
     */
    public function setNumerorecibo($numerorecibo)
    {
        $this->numerorecibo = $numerorecibo;

        return $this;
    }

    /**
     * Get numerorecibo
     *
     * @return string
     */
    public function getNumerorecibo()
    {
        return $this->numerorecibo;
    }

    /**
     * Set esactivo
     *
     * @param integer $esactivo
     *
     * @return Matricula
     */
    public function setEsactivo($esactivo)
    {
        $this->esactivo = $esactivo;

        return $this;
    }

    /**
     * Get esactivo
     *
     * @return integer
     */
    public function getEsactivo()
    {
        return $this->esactivo;
    }

    /**
     * Set nivelnivel
     *
     * @param \AppBundle\Entity\Nivel $nivelnivel
     *
     * @return Matricula
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
}
