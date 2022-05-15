<?php

namespace App\Entity;

use App\Repository\ArtWorkRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations

/**
 * @ORM\Entity(repositoryClass=ArtWorkRepository::class)
 */
class ArtWork
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=3)
     */
    private $width;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=3)
     */
    private $hight;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $materialsUsed;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

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

    public function getWidth(): ?string
    {
        return $this->width;
    }

    public function setWidth(string $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHight(): ?string
    {
        return $this->hight;
    }

    public function setHight(string $hight): self
    {
        $this->hight = $hight;

        return $this;
    }

    public function getMaterialsUsed(): ?string
    {
        return $this->materialsUsed;
    }

    public function setMaterialsUsed(?string $materialsUsed): self
    {
        $this->materialsUsed = $materialsUsed;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

   
}
