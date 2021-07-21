<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 */
class Activity
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $rate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $timetable;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Coach::class, inversedBy="activities")
     */
    private $coaches;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="activities")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=ImageUpload::class, mappedBy="activity")
     */
    private $illustration;

    public function __construct()
    {
        $this->coaches = new ArrayCollection();
        $this->illustration = new ArrayCollection();
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(string $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getTimetable(): ?string
    {
        return $this->timetable;
    }

    public function setTimetable(string $timetable): self
    {
        $this->timetable = $timetable;

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

    /**
     * @return Collection|Coach[]
     */
    public function getCoaches(): Collection
    {
        return $this->coaches;
    }

    public function addCoach(Coach $coach): self
    {
        if (!$this->coaches->contains($coach)) {
            $this->coaches[] = $coach;
        }

        return $this;
    }

    public function removeCoach(Coach $coach): self
    {
        $this->coaches->removeElement($coach);

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|ImageUpload[]
     */
    public function getIllustration(): Collection
    {
        return $this->illustration;
    }

    public function addIllustration(ImageUpload $illustration): self
    {
        if (!$this->illustration->contains($illustration)) {
            $this->illustration[] = $illustration;
            $illustration->setActivity($this);
        }

        return $this;
    }

    public function removeIllustration(ImageUpload $illustration): self
    {
        if ($this->illustration->removeElement($illustration)) {
            // set the owning side to null (unless already changed)
            if ($illustration->getActivity() === $this) {
                $illustration->setActivity(null);
            }
        }

        return $this;
    }
}
