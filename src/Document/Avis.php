<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
* @MongoDB\Document
*/
class Avis
{
/**
* @MongoDB\Id
*/
private $id;

/**
* @MongoDB\Field(type="string")
*/
private $nom;

/**
* @MongoDB\Field(type="string")
*/
private $contenu;

// Getters et Setters

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
}