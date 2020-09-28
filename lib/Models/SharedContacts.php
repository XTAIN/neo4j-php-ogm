<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="SharedContacts", repository="Hedera\Repositories\SharedContactsRepository")
 */
class SharedContacts implements \JsonSerializable
{
    use EntityFactory;
    use SerializationHelper;

    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $phone;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $email;

    /**
     * @var Collection
     *
     * @OGM\Relationship(type="MODULE_CONTACT_IN", direction="BOTH", collection=true, mappedBy="sharedContacts", targetEntity="SharedCustomers")
     */
    protected $sharedCustomers;

    /**
     * @var SharedUsers|null
     *
     * @OGM\Relationship(type="SHARED_CONTACTS_TO_SHARED_USERS", direction="OUTGOING", collection=false, mappedBy="sharedContacts", targetEntity="SharedUsers")
     */
    protected $sharedUsers;

    public function __construct()
    {
        $this->sharedCustomers = new HederaCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return Collection
     */
    public function getSharedCustomers(): Collection
    {
        return $this->sharedCustomers;
    }

    /**
     * @param Collection $sharedCustomers
     */
    public function setSharedCustomers(Collection $sharedCustomers): void
    {
        $this->sharedCustomers = $sharedCustomers;
    }

    /**
     * @return SharedUsers|null
     */
    public function getSharedUsers(): ?SharedUsers
    {
        return $this->sharedUsers;
    }

    /**
     * @param SharedUsers|null $sharedUsers
     */
    public function setSharedUsers(?SharedUsers $sharedUsers): void
    {
        $this->sharedUsers = $sharedUsers;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
