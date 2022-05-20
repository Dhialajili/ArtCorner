<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SubjectRepository::class)
 */
class Subject
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=ArtWork::class, mappedBy="subject")
     */
    private $artWorks;

    public function __construct()
    {
        $this->artWorks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection<int, ArtWork>
     */
    public function getArtWorks(): Collection
    {
        return $this->artWorks;
    }

    public function addArtWork(ArtWork $artWork): self
    {
        if (!$this->artWorks->contains($artWork)) {
            $this->artWorks[] = $artWork;
            $artWork->setSubject($this);
        }

        return $this;
    }

    public function removeArtWork(ArtWork $artWork): self
    {
        if ($this->artWorks->removeElement($artWork)) {
            // set the owning side to null (unless already changed)
            if ($artWork->getSubject() === $this) {
                $artWork->setSubject(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }

}
