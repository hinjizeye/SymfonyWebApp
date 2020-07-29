<?php

namespace App\Entity;

use App\Repository\FileDocumentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FileDocumentsRepository::class)
 */
class FileDocuments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Cases::class, inversedBy="fileDocuments")
     */
    private $Cases;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCases(): ?Cases
    {
        return $this->Cases;
    }

    public function setCases(?Cases $Cases): self
    {
        $this->Cases = $Cases;

        return $this;
    }
}
