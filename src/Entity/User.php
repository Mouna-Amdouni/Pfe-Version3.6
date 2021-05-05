<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"username"})
 * @UniqueEntity(fields={"email"})
 */
class User implements UserInterface, EquatableInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="user")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany(targetEntity=Publication::class, mappedBy="user")
     */
    private $publications;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank( message="Ne doit pas être vide")
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Ne doit pas être vide")
     */
    private $nomComplet;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\NotBlank(message="Ne doit pas être vide")
     * @Assert\Email(message="Email invalide")
     */
    private $email;
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datenaissance;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroTel;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nationalite;
    /**
     * @ORM\Column(type="boolean")
     */
    private $valid;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deleted;

    /**
     * @ORM\Column(type="string", length=255))
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=BlogPost::class, mappedBy="author")
     */
    private $blogPosts;

    /**
     * @ORM\OneToMany(targetEntity=BlogPost::class, mappedBy="creator")
     */
    private $blogPostsCreated;

    /**
     * @ORM\Column(type="boolean")
     */
    private $admin;
    /**
     * @ORM\OneToMany(targetEntity=Service::class, mappedBy="user")
     */
    private $services;

    /**
     * @ORM\OneToMany(targetEntity=Historique::class, mappedBy="user")
     */
    private $historiques;

    /**
     * @ORM\OneToMany(targetEntity=Association::class, mappedBy="UserA")
     */
    private $associations;

    /**
     * @ORM\OneToMany(targetEntity=Topic::class, mappedBy="author")
     */
    private $topics;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="idUser")
     */
    private $messages;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\OneToMany(targetEntity=Opportunite::class, mappedBy="lanceur")
     */
    private $opportunites;

    /**
     * @ORM\OneToMany(targetEntity=Topic::class, mappedBy="idConsultant")
     */
    private $topicsConsultant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lienFbk;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lienInstagram;

    /**
     * @ORM\OneToMany(targetEntity=Actualite::class, mappedBy="user")
     */
    private $actualites;


    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->publications = new ArrayCollection();
        $this->blogPosts = new ArrayCollection();
        $this->blogPostsCreated = new ArrayCollection();
        $this->historiques = new ArrayCollection();
        $this->associations = new ArrayCollection();
        $this->topics = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->opportunites = new ArrayCollection();
        $this->topicsConsultant = new ArrayCollection();
        $this->actualites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
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
     * @see UserInterface
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNomComplet(): ?string
    {
        return $this->nomComplet;
    }

    public function setNomComplet( $nomComplet): self
    {
        $this->nomComplet = $nomComplet;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail( $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function isValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): self
    {
        $this->valid = $valid;

        return $this;
    }

    public function isDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAvatarUrl($size){
        return "https://api.adorable.io/avatars/$size/".$this->username;
    }


    function getColorCode() {
        $code = dechex(crc32($this->getUsername()));
        $code = substr($code, 0, 6);
        return "#".$code;
    }

    /**
     * @Assert\Callback
     */

    public function validate(ExecutionContextInterface $context, $payload)
    {
        /*if (strlen($this->password)< 3){
            $context->buildViolation('Mot de passe trop court')
                ->atPath('justpassword')
                ->addViolation();
        }*/
    }

    /**
     * @return Collection|BlogPost[]
     */
    public function getBlogPosts(): Collection
    {
        return $this->blogPosts;
    }

    public function addBlogPost(BlogPost $blogPost): self
    {
        if (!$this->blogPosts->contains($blogPost)) {
            $this->blogPosts[] = $blogPost;
            $blogPost->setAuthor($this);
        }

        return $this;
    }

    public function removeBlogPost(BlogPost $blogPost): self
    {
        if ($this->blogPosts->contains($blogPost)) {
            $this->blogPosts->removeElement($blogPost);
            // set the owning side to null (unless already changed)
            if ($blogPost->getAuthor() === $this) {
                $blogPost->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BlogPost[]
     */
    public function getBlogPostsCreated(): Collection
    {
        return $this->blogPostsCreated;
    }

    public function addBlogPostsCreated(BlogPost $blogPostsCreated): self
    {
        if (!$this->blogPostsCreated->contains($blogPostsCreated)) {
            $this->blogPostsCreated[] = $blogPostsCreated;
            $blogPostsCreated->setCreator($this);
        }

        return $this;
    }

    public function removeBlogPostsCreated(BlogPost $blogPostsCreated): self
    {
        if ($this->blogPostsCreated->contains($blogPostsCreated)) {
            $this->blogPostsCreated->removeElement($blogPostsCreated);
            // set the owning side to null (unless already changed)
            if ($blogPostsCreated->getCreator() === $this) {
                $blogPostsCreated->setCreator(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return "$this->nomComplet ($this->id)";
    }

    public function isAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }



    /**
     * @return mixed
     */
    public function getNumeroTel()
    {
        return $this->numeroTel;
    }

    /**
     * @param mixed $numeroTel
     * @return User
     */
    public function setNumeroTel($numeroTel)
    {
        $this->numeroTel = $numeroTel;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

//
//    /**
//     * @ORM\Column(type="string", length=255, nullable=true)
//     */
//    private $plainPassword;
//
//    /**
//     * @return mixed
//     */
//    public function getPlainPassword()
//    {
//        return $this->plainPassword;
//    }
//
//    /**
//     * @param mixed $plainPassword
//     * @return User
//     */
//    public function setPlainPassword($plainPassword)
//    {
//        $this->plainPassword = $plainPassword;
//        return $this;
//    }

    /**
     * @return Collection|Historique[]
     */
    public function getHistoriques(): Collection
    {
        return $this->historiques;
    }

    public function addHistorique(Historique $historique): self
    {
        if (!$this->historiques->contains($historique)) {
            $this->historiques[] = $historique;
            $historique->setUser($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historiques->contains($historique)) {
            $this->historiques->removeElement($historique);
            // set the owning side to null (unless already changed)
            if ($historique->getUser() === $this) {
                $historique->setUser(null);
            }
        }

        return $this;
    }


    public function isEqualTo(UserInterface $user)
    {
        if ($user instanceof User)
        return $this->isValid() && !$this->isDeleted() && $this->getPassword() == $user->getPassword() && $this->getUsername() == $user->getUsername()
            && $this->getEmail() == $user->getEmail() ;
    }

    /**
     * @return Collection|Association[]
     */
    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function addAssociation(Association $association): self
    {
        if (!$this->associations->contains($association)) {
            $this->associations[] = $association;
            $association->setUserA($this);
        }

        return $this;
    }

    public function removeAssociation(Association $association): self
    {
        if ($this->associations->removeElement($association)) {
            // set the owning side to null (unless already changed)
            if ($association->getUserA() === $this) {
                $association->setUserA(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Topic[]
     */
    public function getTopics(): Collection
    {
        return $this->topics;
    }

    public function addTopic(Topic $topic): self
    {
        if (!$this->topics->contains($topic)) {
            $this->topics[] = $topic;
            $topic->setAuthor($this);
        }

        return $this;
    }

    public function removeTopic(Topic $topic): self
    {
        if ($this->topics->removeElement($topic)) {
            // set the owning side to null (unless already changed)
            if ($topic->getAuthor() === $this) {
                $topic->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setIdUser($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getIdUser() === $this) {
                $message->setIdUser(null);
            }
        }

        return $this;
    }


    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection|Opportunite[]
     */
    public function getOpportunites(): Collection
    {
        return $this->opportunites;
    }

    public function addOpportunite(Opportunite $opportunite): self
    {
        if (!$this->opportunites->contains($opportunite)) {
            $this->opportunites[] = $opportunite;
            $opportunite->setLanceur($this);
        }

        return $this;
    }

    public function removeOpportunite(Opportunite $opportunite): self
    {
        if ($this->opportunites->removeElement($opportunite)) {
            // set the owning side to null (unless already changed)
            if ($opportunite->getLanceur() === $this) {
                $opportunite->setLanceur(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * @param mixed $datenaissance
     */
    public function setDatenaissance($datenaissance): void
    {
        $this->datenaissance = $datenaissance;
    }


    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setUser($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getUser() === $this) {
                $commentaire->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Publication[]
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications[] = $publication;
            $publication->setUser($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getUser() === $this) {
                $publication->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Topic[]
     */
    public function getTopicsConsultant(): Collection
    {
        return $this->topicsConsultant;
    }

    public function addTopicsConsultant(Topic $topicsConsultant): self
    {
        if (!$this->topicsConsultant->contains($topicsConsultant)) {
            $this->topicsConsultant[] = $topicsConsultant;
            $topicsConsultant->setIdConsultant($this);
        }

        return $this;
    }

    public function removeTopicsConsultant(Topic $topicsConsultant): self
    {
        if ($this->topicsConsultant->removeElement($topicsConsultant)) {
            // set the owning side to null (unless already changed)
            if ($topicsConsultant->getIdConsultant() === $this) {
                $topicsConsultant->setIdConsultant(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setUser($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getUser() === $this) {
                $service->setUser(null);
            }
        }

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getLienFbk(): ?string
    {
        return $this->lienFbk;
    }

    public function setLienFbk(?string $lienFbk): self
    {
        $this->lienFbk = $lienFbk;

        return $this;
    }

    public function getLienInstagram(): ?string
    {
        return $this->lienInstagram;
    }

    public function setLienInstagram(?string $lienInstagram): self
    {
        $this->lienInstagram = $lienInstagram;

        return $this;
    }

    /**
     * @return Collection|Actualite[]
     */
    public function getActualites(): Collection
    {
        return $this->actualites;
    }

    public function addActualite(Actualite $actualite): self
    {
        if (!$this->actualites->contains($actualite)) {
            $this->actualites[] = $actualite;
            $actualite->setUser($this);
        }

        return $this;
    }

    public function removeActualite(Actualite $actualite): self
    {
        if ($this->actualites->removeElement($actualite)) {
            // set the owning side to null (unless already changed)
            if ($actualite->getUser() === $this) {
                $actualite->setUser(null);
            }
        }

        return $this;
    }
}
