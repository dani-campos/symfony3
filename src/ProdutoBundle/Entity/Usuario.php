<?php

namespace ProdutoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="ProdutoBundle\Repository\UsuarioRepository")
 */
class Usuario
{
    /** 
     * Constructor 
     */ 
    public function __construct() 
    { 
        $this->produto = new ArrayCollection(); 
    }

    /** 
     * @var ArrayCollection 
     * 
     * @ORM\OneToMany(targetEntity="Produto", mappedBy="usuario", cascade={"remove"}) 
     */ 
    private $produto;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     * @Assert\NotBlank
     */
    private $nome;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Usuario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Add produto
     *
     * @param \ProdutoBundle\Entity\Produto $produto
     *
     * @return Usuario
     */
    public function addProduto(\ProdutoBundle\Entity\Produto $produto)
    {
        $this->produto[] = $produto;

        return $this;
    }

    /**
     * Remove produto
     *
     * @param \ProdutoBundle\Entity\Produto $produto
     */
    public function removeProduto(\ProdutoBundle\Entity\Produto $produto)
    {
        $this->produto->removeElement($produto);
    }

    /**
     * Get produto
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /** 
     * @return string 
     */ 
    public function __toString() 
    { 
        return $this->getNome(); 
    }
}
