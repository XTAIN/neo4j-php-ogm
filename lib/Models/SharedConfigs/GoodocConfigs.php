<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\SharedConfigs;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Models\SharedConfigs;

/**
 * @OGM\Node(label="SharedConfigs", repository="Hedera\Repositories\SharedConfigsRepository")
 */
class GoodocConfigs extends SharedConfigs
{
    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $amo;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string")
     */
    protected $credentials;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $folders;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $signatories;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $names;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array", key="amo_user")
     * @OGM\Convert(type="nested")
     */
    protected $amoUser;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $widget;

    /**
     * @var string|null
     *
     * @OGM\Property(type="array", key="account_unlink_by")
     */
    protected $accountUnlinkBy;

    /**
     * @var string|null
     *
     * @OGM\Property(type="array", key="account_linked_by")
     */
    protected $accountLinkedBy;

    /**
     * @return string|null
     */
    public function getAmo(): ?string
    {
        return $this->amo;
    }

    /**
     * @param string|null $amo
     */
    public function setAmo(?string $amo): void
    {
        $this->amo = $amo;
    }

    /**
     * @return string|null
     */
    public function getCredentials(): ?string
    {
        return $this->credentials;
    }

    /**
     * @param string|null $credentials
     */
    public function setCredentials(?string $credentials): void
    {
        $this->credentials = $credentials;
    }

    /**
     * @return mixed
     */
    public function getFolders()
    {
        return $this->folders;
    }

    /**
     * @param mixed $folders
     */
    public function setFolders($folders): void
    {
        $this->folders = $folders;
    }

    /**
     * @return mixed
     */
    public function getSignatories()
    {
        return $this->signatories;
    }

    /**
     * @param mixed $signatories
     */
    public function setSignatories($signatories): void
    {
        $this->signatories = $signatories;
    }

    /**
     * @return mixed
     */
    public function getNames()
    {
        return $this->names;
    }

    /**
     * @param mixed $names
     */
    public function setNames($names): void
    {
        $this->names = $names;
    }

    /**
     * @return mixed
     */
    public function getAmoUser()
    {
        return $this->amoUser;
    }

    /**
     * @param mixed $amoUser
     */
    public function setAmoUser($amoUser): void
    {
        $this->amoUser = $amoUser;
    }

    /**
     * @return mixed
     */
    public function getWidget()
    {
        return $this->widget;
    }

    /**
     * @param mixed $widget
     */
    public function setWidget($widget): void
    {
        $this->widget = $widget;
    }

    /**
     * @return string|null
     */
    public function getAccountUnlinkBy(): ?string
    {
        return $this->accountUnlinkBy;
    }

    /**
     * @param string|null $accountUnlinkBy
     */
    public function setAccountUnlinkBy(?string $accountUnlinkBy): void
    {
        $this->accountUnlinkBy = $accountUnlinkBy;
    }

    /**
     * @return string|null
     */
    public function getAccountLinkedBy(): ?string
    {
        return $this->accountLinkedBy;
    }

    /**
     * @param string|null $accountLinkedBy
     */
    public function setAccountLinkedBy(?string $accountLinkedBy): void
    {
        $this->accountLinkedBy = $accountLinkedBy;
    }
}
