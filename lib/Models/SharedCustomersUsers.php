<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.09.12
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;

/**
 * @OGM\Node(label="SharedCustomersUsers", repository="Hedera\Repositories\SharedCustomersUsersRepository")
 */
class SharedCustomersUsers implements \JsonSerializable
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
    protected $email;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $userId;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $lang;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $rights;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $roles;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $groups;

    /**
     * @var SharedAmocrm|null
     *
     * @OGM\Relationship(type="AMOCRM_CU_USER_IN", direction="OUTGOING", collection=false, mappedBy="sharedCustomersUsers", targetEntity="SharedAmocrm")
     */
    protected $sharedAmocrm;

    public function __construct()
    {
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
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     */
    public function setLang(string $lang): void
    {
        $this->lang = $lang;
    }

    /**
     * @return mixed
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * @param mixed $rights
     */
    public function setRights($rights): void
    {
        $this->rights = $rights;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @return mixed
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param mixed $groups
     */
    public function setGroups($groups): void
    {
        $this->groups = $groups;
    }

    /**
     * @return SharedAmocrm|null
     */
    public function getSharedAmocrm(): ?SharedAmocrm
    {
        return $this->sharedAmocrm;
    }

    /**
     * @param SharedAmocrm|null $sharedAmocrm
     */
    public function setSharedAmocrm(?SharedAmocrm $sharedAmocrm): void
    {
        $this->sharedAmocrm = $sharedAmocrm;
    }

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
