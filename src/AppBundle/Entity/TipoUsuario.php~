<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;
/**
 * TipoUsuario
 *
 * @ORM\Table(name="tipo_usuario")
 * @ORM\Entity
 */
class TipoUsuario implements RoleInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTipo_Usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipoUsuario;
    /**
     * @var string
     *
     * @ORM\Column(name="nomTipoUsuario", type="string", length=45, nullable=false)
     */
    private $nomtipousuario;
    public function getRole()
    {
        return 'ROLE_'.$this->nomtipousuario.'';
    }
    /**
     * Get idtipoUsuario
     *
     * @return integer
     */
    public function getIdtipoUsuario()
    {
        return $this->idtipoUsuario;
    }
    /**
     * Set nomtipousuario
     *
     * @param string $nomtipousuario
     *
     * @return TipoUsuario
     */
    public function setNomtipousuario($nomtipousuario)
    {
        $this->nomtipousuario = $nomtipousuario;
        return $this;
    }
    /**
     * Get nomtipousuario
     *
     * @return string
     */
    public function getNomtipousuario()
    {
        return $this->nomtipousuario;
    }
}
