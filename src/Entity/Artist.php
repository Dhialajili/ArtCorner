<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 * @Vich\Uploadable
 */
class Artist
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $Bio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instagram;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitter;

   

    /**
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $workStatus;

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
     * @Vich\UploadableField(mapping="profile_images", fileNameProperty="coverPicture")
     * @var File|null
     */
    private $coverimageFile;

     /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coverPicture;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="artist", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=ArtWork::class, mappedBy="artist")
     */
    private $artwork;

    public function __construct()
    {
        $this->artwork = new ArrayCollection();
    }

    

    

    

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

    public function getBio(): ?string
    {
        return $this->Bio;
    }

    public function setBio(?string $Bio): self
    {
        $this->Bio = $Bio;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }
    

      

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getWorkStatus(): ?string
    {
        return $this->workStatus;
    }

    public function setWorkStatus(string $workStatus): self
    {
        $this->workStatus = $workStatus;

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

    public function getCoverimageFile()
    {
        return $this->coverimageFile;
    }

    public function setCoverimageFile(File $coverimageFile = null) : void
    {
        $this->coverimageFile = $coverimageFile;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if (null !== $coverimageFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTimeImmutable('');
        }
    }

   
    public function getCoverPicture(): ?string
    {
        return $this->coverPicture;
    }

    public function setCoverPicture(?string $coverPicture): self
    {
        $this->coverPicture = $coverPicture;

        return $this;
    }
    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            
            //......
        ];
    }

public function __unserialize(array $serialized): Artist
{
    $this->id = $serialized['id'];
    
    // .....
    return $this;
}

public function getUser(): ?User
{
    return $this->user;
}

public function setUser(?User $user): self
{
    // unset the owning side of the relation if necessary
    if ($user === null && $this->user !== null) {
        $this->user->setArtist(null);
    }

    // set the owning side of the relation if necessary
    if ($user !== null && $user->getArtist() !== $this) {
        $user->setArtist($this);
    }

    $this->user = $user;

    return $this;
}

/**
 * @return Collection<int, ArtWork>
 */
public function getArtwork(): Collection
{
    return $this->artwork;
}

public function addArtwork(ArtWork $artwork): self
{
    if (!$this->artwork->contains($artwork)) {
        $this->artwork[] = $artwork;
        $artwork->setArtist($this);
    }

    return $this;
}

public function removeArtwork(ArtWork $artwork): self
{
    if ($this->artwork->removeElement($artwork)) {
        // set the owning side to null (unless already changed)
        if ($artwork->getArtist() === $this) {
            $artwork->setArtist(null);
        }
    }

    return $this;
}






}
