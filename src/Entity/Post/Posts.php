<?php

namespace App\Entity\Post;

use App\Repository\Post\PostsRepository;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity('slug', message: 'ce slug existe déjà')]
class Posts
{
    const STATE = ['STATE_DRAFT','STATE_PUBLISH'];
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: 'text', length: 255, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $state = Posts::STATE[0];

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToOne(inversedBy: 'post', targetEntity: Thumbnail::class, cascade: ['persist', 'remove'])]
    private  ?Thumbnail $thumbnail = null;

    /**
     * @param \DateTimeImmutable|null $updatedAt
     * @param \DateTimeImmutable|null $createdAt
     */
    public function __construct()
    {
        $this->updatedAt =new \DateTimeImmutable();
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @return Thumbnail
     */
    public function getThumbnail(): ?Thumbnail
    {
        return $this->thumbnail;
    }

    /**
     * @param Thumbnail $thumbnail
     */
    public function setThumbnail(Thumbnail $thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    #[ORM\PreUpdate]
    public function preUpdateAt(){
        $this->updatedAt =new \DateTimeImmutable();
    }

    public function prePersist(){
        $this->slug = (new Slugify())->slugify($this->title);
    }

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(?string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function __toString(){
        return $this->title;
    }
}
