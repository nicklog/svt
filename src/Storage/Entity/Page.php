<?php

declare(strict_types=1);

namespace App\Storage\Entity;

use App\Storage\Entity\Common\EnabledInterface;
use App\Storage\Repository\PageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\AbstractString;
use Symfony\Component\String\Slugger\SluggerInterface;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page extends AbstractEntity implements EnabledInterface
{
    #[ORM\Column(type: Types::STRING)]
    private string $title;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private string|null $subTitle;

    #[ORM\Column(type: Types::TEXT)]
    private string $content;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => true])]
    private bool $enabled = true;

    public function __construct(
        string $title,
        string|null $subTitle,
        string $content,
    ) {
        $this->title    = $title;
        $this->subTitle = $subTitle;
        $this->content  = $content;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSubTitle(): string|null
    {
        return $this->subTitle;
    }

    public function setSubTitle(string|null $subTitle): void
    {
        $this->subTitle = $subTitle;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getSlug(SluggerInterface $slugger): AbstractString
    {
        return $slugger->slug($this->getTitle());
    }
}
