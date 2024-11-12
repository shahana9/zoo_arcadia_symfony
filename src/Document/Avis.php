<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use phpDocumentor\Reflection\Types\Boolean;

#[ODM\Document(collection: "avis")]
class Avis
{
    #[ODM\Id]
    private $id;

    #[ODM\Field(type: "string")]
    private $nom;

    #[ODM\Field(type: "string")]
    private $contenu;

    #[ODM\Field(type: "boolean")]
    private $isValidated;

    #[ODM\Field(type: "date")] 
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getisValidated(): ?Bool
    {
        return $this->isValidated;
    }

    public function setisValidated(bool $isValidated): self
    {
        $this->isValidated = $isValidated;
        return $this;
    }

    
    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

   

}
