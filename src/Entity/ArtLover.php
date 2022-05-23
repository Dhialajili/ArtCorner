<?php

namespace App\Entity;

use App\Repository\ArtLoverRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=ArtLoverRepository::class)
 * @Vich\Uploadable
 */
class ArtLover
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
    private $username;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profilePicture;

    /**
     * @Vich\UploadableField(mapping="profile_images", fileNameProperty="profilePicture")
     * @var File|null
     */
    private $profileimageFile;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="artlover", cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }
    public function getProfileimageFile()
    {
        return $this->profileimageFile;
    }

    public function setProfileimageFile(File $profileimageFile = null) : void
    {
        $this->profileimageFile = $profileimageFile;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if (null !== $profileimageFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTimeImmutable('');
        }
    }
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setArtlover(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getArtlover() !== $this) {
            $user->setArtlover($this);
        }

        $this->user = $user;

        return $this;
    }
    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            
            //......
        ];
    }

public function __unserialize(array $serialized): ArtLover
{
    $this->id = $serialized['id'];
    
    // .....
    return $this;
}
}
