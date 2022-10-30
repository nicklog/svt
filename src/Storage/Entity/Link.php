<?php

declare(strict_types=1);

namespace App\Storage\Entity;

use App\Storage\Repository\LinkRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Stringable;

#[ORM\Entity(repositoryClass: LinkRepository::class)]
class Link extends AbstractEntity implements Stringable
{
    #[ORM\Column(type: Types::STRING)]
    private string $name;

    #[ORM\Column(type: Types::STRING)]
    private string $uri;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => true])]
    private bool $enabled = true;

    public function __construct(string $name, string $uri)
    {
        $this->name = $name;
        $this->uri  = $uri;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }
}