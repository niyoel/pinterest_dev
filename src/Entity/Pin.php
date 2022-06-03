<?php

namespace App\Entity;
use App\Repository\PinRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: PinRepository::class)]
#[ORM\Table(name:"pins")]
#[ORM\HasLifecycleCallbacks]

class Pin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message:"Votre champs ne peut pas être vide")]
    #[Assert\Length(min:3, minMessage:'Vous devez avoir un titre de minimum {{ limit }} caractères ! ')]
    private $title;
   

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message:"Votre champs ne peut pas être vide")]
    #[Assert\Length(min:10, minMessage:'Vous devez avoir un description de minimum {{ limit }} caractères ! ')]
    private $description;

    #[ORM\Column(type: 'datetime', options:['default'=>'CURRENT_TIMESTAMP'])]
    private $createdAt;

    #[ORM\Column(type: 'datetime', options:['default'=>'CURRENT_TIMESTAMP'])]
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    #[ORM\PrePersist]                
    #[ORM\PreUpdate]    
    public function updateTimestamps()
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable);
        }
        $this->setUpdatedAt(new \DateTimeImmutable);
    }

    
}
