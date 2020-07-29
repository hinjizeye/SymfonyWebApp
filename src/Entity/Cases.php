<?php

namespace App\Entity;

use App\Repository\CasesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CasesRepository::class)
 */
class Cases
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Surname;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $WhatHappened;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $WhenItHappened;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $File;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $EvidenceGallery;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="cases")
     */
    private $categoryId;

    /**
     * @ORM\OneToMany(targetEntity=FileDocuments::class, mappedBy="Cases")
     */
    private $fileDocuments;

    public function __construct()
    {
        $this->fileDocuments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->Surname;
    }

    public function setSurname(string $Surname): self
    {
        $this->Surname = $Surname;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(?string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getWhatHappened(): ?string
    {
        return $this->WhatHappened;
    }

    public function setWhatHappened(string $WhatHappened): self
    {
        $this->WhatHappened = $WhatHappened;

        return $this;
    }

    public function getWhenItHappened(): ?string
    {
        return $this->WhenItHappened;
    }

    public function setWhenItHappened(string $WhenItHappened): self
    {
        $this->WhenItHappened = $WhenItHappened;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->File;
    }

    public function setFile(?string $File): self
    {
        $this->File = $File;

        return $this;
    }

    public function getEvidenceGallery(): ?string
    {
        return $this->EvidenceGallery;
    }

    public function setEvidenceGallery(?string $EvidenceGallery): self
    {
        $this->EvidenceGallery = $EvidenceGallery;

        return $this;
    }

    public function getCategoryId(): ?Category
    {
        return $this->categoryId;
    }

    public function setCategoryId(?Category $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return Collection|FileDocuments[]
     */
    public function getFileDocuments(): Collection
    {
        return $this->fileDocuments;
    }

    public function addFileDocument(FileDocuments $fileDocument): self
    {
        if (!$this->fileDocuments->contains($fileDocument)) {
            $this->fileDocuments[] = $fileDocument;
            $fileDocument->setCases($this);
        }

        return $this;
    }

    public function removeFileDocument(FileDocuments $fileDocument): self
    {
        if ($this->fileDocuments->contains($fileDocument)) {
            $this->fileDocuments->removeElement($fileDocument);
            // set the owning side to null (unless already changed)
            if ($fileDocument->getCases() === $this) {
                $fileDocument->setCases(null);
            }
        }

        return $this;
    }
}
