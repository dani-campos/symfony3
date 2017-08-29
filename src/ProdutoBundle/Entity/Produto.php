<?php

namespace ProdutoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile; 

/**
 * Produto
 *
 * @ORM\Table(name="produto")
 * @ORM\Entity(repositoryClass="ProdutoBundle\Repository\ProdutoRepository")
 */
class Produto
{
    /** 
     * @var Usuario 
     * 
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="produtos") 
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false) 
     * @Assert\NotBlank 
     */ 
    private $usuario;

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
     * @var string
     *
     * @ORM\Column(name="preco", type="decimal", precision=10, scale=0)
     * @Assert\NotBlank
     */
    private $preco;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255, nullable=true)
     */
    private $descricao;

    /** 
     * @var string 
     * 
     * @ORM\Column(name="img", type="string", length=255, nullable=true) 
     */ 
    private $img; 
    
    /** 
     * @Assert\File(maxSize="1000000") 
     */ 
    private $file;

    /** 
     * Relative path. 
     * Get web path to upload directory. 
     * 
     * @return string 
     */ 
    protected function getUploadPath() 
    { 
        return 'uploads/img'; 
    }

    /** 
     * Absolute path. 
     * Get absolute path to upload directory. 
     * 
     * @return string 
     */ 
    protected function getUploadAbsolutePath() 
    { 
        return __DIR__ . '/../../../../web/' . $this->getUploadPath(); 
    }

    /** 
     * Relative path. 
     * Get web path to a img. 
     * 
     * @return null|string 
     */ 
    public function getImgWeb() 
    { 
        return null === $this->getImg() 
            ? null 
            : $this->getUploadPath() . '/' . $this->getImg(); 
    }

    /** 
     * Get path on disk to a img. 
     * 
     * @return null|string 
     *   Absolute path. 
     */ 
    public function getImgAbsolute() 
    { 
        return null === $this->getImg() 
            ? null 
            : $this->getUploadAbsolutePath() . '/' . $this->getImg(); 
    }

    /** 
     * Upload a img file. 
     */ 
    public function upload() 
    { 
        if (null === $this->getFile()) { 
            return; 
        } 
        $filename = $this->getFile()->getClientOriginalName(); 
        $this->getFile()->move($this->getUploadAbsolutePath(), $filename); 
        $this->setImg($filename); 
        $this->setFile(); 
    }


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
     * @return Produto
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
     * Set preco
     *
     * @param string $preco
     *
     * @return Produto
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }

    /**
     * Get preco
     *
     * @return string
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Produto
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /** 
     * Set usuario 
     * 
     * @param \ProdutoBundle\Entity\Usuario $usuario 
     * @return Produto 
     */ 
    public function setUsuario(\ProdutoBundle\Entity\Usuario $usuario) 
    { 
        $this->usuario = $usuario; 

        return $this; 
    } 

    /** 
     * Get usuario 
     * 
     * @return \ProdutoBundle\Entity\Usuario 
     */ 
    public function getUsuario() 
    { 
        return $this->usuario; 
    }

    /** 
     * Get img 
     * 
     * @return string 
     */ 
    public function getImg() 
    { 
        return $this->img; 
    } 

    /** 
     * Set img 
     * 
     * @param string $img 
     * @return Image 
     */ 
    public function setImg($img) 
    { 
        $this->img = $img; 
    } 

    /** 
     * Get file. 
     * 
     * @return UploadedFile 
     */ 
    public function getFile() 
    { 
        return $this->file; 
    } 

    /** 
     * Set file. 
     * 
     * @param UploadedFile $file 
     */ 
    public function setFile(UploadedFile $file = null) 
    { 
        $this->file = $file; 
    }
 
}

