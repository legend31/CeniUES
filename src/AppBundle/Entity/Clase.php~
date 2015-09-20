<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clase
 *
 * @ORM\Table(name="clase", indexes={@ORM\Index(name="fk_Clase_Nivel1_idx", columns={"Nivel_idNivel"}), @ORM\Index(name="fk_Clase_Local1_idx", columns={"Local_idLocal"}), @ORM\Index(name="fk_Clase_Docente1_idx", columns={"Docente_carnetDocente"})})
 * @ORM\Entity
 */
class Clase
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idClase", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idclase;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horario", type="time", nullable=true)
     */
    private $horario;

    /**
     * @var string
     *
     * @ORM\Column(name="turno", type="string", length=45, nullable=true)
     */
    private $turno;

    /**
     * @var \Docente
     *
     * @ORM\ManyToOne(targetEntity="Docente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Docente_carnetDocente", referencedColumnName="carnetDocente")
     * })
     */
    private $docenteCarnetdocente;

    /**
     * @var \Local
     *
     * @ORM\ManyToOne(targetEntity="Local")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Local_idLocal", referencedColumnName="idLocal")
     * })
     */
    private $locallocal;

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
     * Get idclase
     *
     * @return integer
     */
    public function getIdclase()
    {
        return $this->idclase;
    }

    /**
     * Set horario
     *
     * @param \DateTime $horario
     *
     * @return Clase
     */
    public function setHorario($horario)
    {
        $this->horario = $horario;

        return $this;
    }

    /**
     * Get horario
     *
     * @return \DateTime
     */
    public function getHorario()
    {
        return $this->horario;
    }

    /**
     * Set turno
     *
     * @param string $turno
     *
     * @return Clase
     */
    public function setTurno($turno)
    {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get turno
     *
     * @return string
     */
    public function getTurno()
    {
        return $this->turno;
    }

    /**
     * Set docenteCarnetdocente
     *
     * @param \AppBundle\Entity\Docente $docenteCarnetdocente
     *
     * @return Clase
     */
    public function setDocenteCarnetdocente(\AppBundle\Entity\Docente $docenteCarnetdocente = null)
    {
        $this->docenteCarnetdocente = $docenteCarnetdocente;

        return $this;
    }

    /**
     * Get docenteCarnetdocente
     *
     * @return \AppBundle\Entity\Docente
     */
    public function getDocenteCarnetdocente()
    {
        return $this->docenteCarnetdocente;
    }

    /**
     * Set locallocal
     *
     * @param \AppBundle\Entity\Local $locallocal
     *
     * @return Clase
     */
    public function setLocallocal(\AppBundle\Entity\Local $locallocal = null)
    {
        $this->locallocal = $locallocal;

        return $this;
    }

    /**
     * Get locallocal
     *
     * @return \AppBundle\Entity\Local
     */
    public function getLocallocal()
    {
        return $this->locallocal;
    }

    /**
     * Set nivelnivel
     *
     * @param \AppBundle\Entity\Nivel $nivelnivel
     *
     * @return Clase
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
