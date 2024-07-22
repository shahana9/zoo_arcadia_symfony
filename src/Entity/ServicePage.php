<?php
namespace App\Entity;

use App\Repository\ServicePageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicePageRepository::class)]
class ServicePage
{
#[ORM\Id]
#[ORM\GeneratedValue]
#[ORM\Column]
private ?int $id = null;

#[ORM\Column(length: 255)]
private ?string $title = null;

#[ORM\Column(length: 255)]
private ?string $subTitle1 = null;

#[ORM\Column(length: 255)]
private ?string $subTitle2 = null;

#[ORM\Column(length: 255)]
private ?string $subTitle3 = null;

#[ORM\Column(length: 255)]
private ?string $content = null;

#[ORM\Column(length: 255, nullable: true)]
private ?string $images = null;

public function getId(): ?int
{
return $this->id;
}

public function getTitle(): ?string
{
return $this->title;
}

public function setTitle(string $title): self
{
$this->title = $title;
return $this;
}

public function getSubTitle1(): ?string
{
return $this->subTitle1;
}

public function setSubTitle1(string $subTitle1): self
{
$this->subTitle1 = $subTitle1;
return $this;
}

public function getSubTitle2(): ?string
{
return $this->subTitle2;
}

public function setSubTitle2(string $subTitle2): self
{
$this->subTitle2 = $subTitle2;
return $this;
}

public function getSubTitle3(): ?string
{
return $this->subTitle3;
}

public function setSubTitle3(string $subTitle3): self
{
$this->subTitle3 = $subTitle3;
return $this;
}

public function getContent(): ?string
{
return $this->content;
}

public function setContent(string $content): self
{
$this->content = $content;
return $this;
}

public function getImages(): ?string
{
return $this->images;
}

public function setImages(?string $images): self
{
$this->images = $images;
return $this;
}
}