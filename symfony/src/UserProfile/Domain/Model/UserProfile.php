<?php

declare(strict_types=1);

namespace App\UserProfile\Domain\Model;

use App\Common\Domain\Aggregate\AggregateRoot;
use App\UserProfile\Domain\Event\UserProfileCreatedEvent;

/**
 * One User can potentialy own/use multiple profiles with different roles such as personal profile or a company profile.
 * UserProfile contains publicly accessible data,
 * while User contains personal data which are not publickly accessible (GDPR).
 */
class UserProfile extends AggregateRoot
{
    public function __construct(
        private ?int $id,
        private string $name,
        private string $email,
        private ?\DateTime $createdAt,
    ) {
        $this->createdAt = $createdAt ?? new \DateTime();
    }

    public static function create(
        ?int $id,
        string $name,
        string $email
    ): self {
        $userProfile = new self($id, $name, $email, new \DateTime());
        $userProfile->record(new UserProfileCreatedEvent($userProfile));

        return $userProfile;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'class' => get_class($this), // @TODO possible problem with Doctrine's Proxy classes
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'createdAt' => $this->getCreatedAt()->format('c'),
        ];
    }

    public static function fromArray(array $parameters): self
    {
        return new self(
            $parameters['id'],
            $parameters['name'],
            $parameters['email'],
            new \DateTime($parameters['createdAt']),
        );
    }
}
