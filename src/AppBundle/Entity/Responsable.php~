<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Responsable
 *
 * @ORM\Table(name="responsable")
 * @ORM\Entity
 */
class Responsable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idResponsable", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idresponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreResponsable", type="string", length=45, nullable=false)
     */
    private $nombreresponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="parentesco", type="string", length=45, nullable=false)
     */
    private $parentesco;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=8, nullable=false)
     */
    private $telefono;



    /**
     * Get idresponsable
     *
     * @return integer
     */
    public function getIdresponsable()
    {
        return $this->idresponsable;
    }

    /**
     * Set nombreresponsable
     *
     * @param string $nombreresponsable
     *
     * @return Responsable
     */
    public function setNombreresponsable($nombreresponsable)
    {
        $this->nombreresponsable = $nombreresponsable;

        return $this;
    }

    /**
     * Get nombreresponsable
     *
     * @return string
     */
    public function getNombreresponsable()
    {
        return $this->nombreresponsable;
    }

    /**
     * Set parentesco
     *
     * @param string $parentesco
     *
     * @return Responsable
     */
    public function setParentesco($parentesco)
    {
        $this->parentesco = $parentesco;

        return $this;
    }

    /**
     * Get parentesco
     *
     * @return string
     */
    public function getParentesco()
    {
        return $this->parentesco;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Responsable
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }
}
