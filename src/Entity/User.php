<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $joinedAt;

    /**
     * @ORM\OneToOne(targetEntity=Artist::class, inversedBy="user", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $artist;

    /**
     * @ORM\OneToOne(targetEntity=ProfessionalProfile::class, inversedBy="user", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $professional;

    /**
     * @ORM\OneToMany(targetEntity=ArtWork::class, mappedBy="user")
     */
    private $artWorks;

    /**
     * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="sender", orphanRemoval=true)
     */
    private $sent;

    /**
     * @ORM\OneToMany(targetEntity=Messages::class, mappedBy="recipient", orphanRemoval=true)
     */
    private $received;

    /**
     * @ORM\OneToOne(targetEntity=ArtLover::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $artlover;

    /**
     * @ORM\OneToMany(targetEntity=Comission::class, mappedBy="user")
     */
    private $comission;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="user")
     */
    private $reservation;

    public function __construct()
    {
        $this->artWorks = new ArrayCollection();
        $this->sent = new ArrayCollection();
        $this->received = new ArrayCollection();
        $this->comission = new ArrayCollection();
        $this->reservation = new ArrayCollection();
    }

  

  

    

   

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getJoinedAt(): ?\DateTimeInterface
    {
        return $this->joinedAt;
    }

    public function getArtistProfile(): ?Artist
    {
        return $this->artistProfile;
    }

    public function setArtistProfile(?Artist $artistProfile): self
    {
        $this->artistProfile = $artistProfile;

        return $this;
    }

    public function __toString()
    {
        return $this->email;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getProfessional(): ?ProfessionalProfile
    {
        return $this->professional;
    }

    public function setProfessional(?ProfessionalProfile $professional): self
    {
        $this->professional = $professional;

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
            $artWork->setUser($this);
        }

        return $this;
    }

    public function removeArtWork(ArtWork $artWork): self
    {
        if ($this->artWorks->removeElement($artWork)) {
            // set the owning side to null (unless already changed)
            if ($artWork->getUser() === $this) {
                $artWork->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getSent(): Collection
    {
        return $this->sent;
    }

    public function addSent(Messages $sent): self
    {
        if (!$this->sent->contains($sent)) {
            $this->sent[] = $sent;
            $sent->setSender($this);
        }

        return $this;
    }

    public function removeSent(Messages $sent): self
    {
        if ($this->sent->removeElement($sent)) {
            // set the owning side to null (unless already changed)
            if ($sent->getSender() === $this) {
                $sent->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getReceived(): Collection
    {
        return $this->received;
    }

    public function addReceived(Messages $received): self
    {
        if (!$this->received->contains($received)) {
            $this->received[] = $received;
            $received->setRecipient($this);
        }

        return $this;
    }

    public function removeReceived(Messages $received): self
    {
        if ($this->received->removeElement($received)) {
            // set the owning side to null (unless already changed)
            if ($received->getRecipient() === $this) {
                $received->setRecipient(null);
            }
        }

        return $this;
    }

    public function getArtlover(): ?ArtLover
    {
        return $this->artlover;
    }

    public function setArtlover(?ArtLover $artlover): self
    {
        $this->artlover = $artlover;

        return $this;
    }

    /**
     * @return Collection<int, Comission>
     */
    public function getComission(): Collection
    {
        return $this->comission;
    }

    public function addComission(Comission $comission): self
    {
        if (!$this->comission->contains($comission)) {
            $this->comission[] = $comission;
            $comission->setUser($this);
        }

        return $this;
    }

    public function removeComission(Comission $comission): self
    {
        if ($this->comission->removeElement($comission)) {
            // set the owning side to null (unless already changed)
            if ($comission->getUser() === $this) {
                $comission->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservation(): Collection
    {
        return $this->reservation;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservation->contains($reservation)) {
            $this->reservation[] = $reservation;
            $reservation->setUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUser() === $this) {
                $reservation->setUser(null);
            }
        }

        return $this;
    }

   

    

}
