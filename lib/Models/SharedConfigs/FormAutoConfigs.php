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
class FormAutoConfigs extends SharedConfigs
{
    /**
     * @var mixed
     *
     * @OGM\Property(type="array", key="advanced_settings")
     * @OGM\Convert(type="nested")
     */
    protected $advancedSettings;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $form;

    /**
     * @var int|null
     *
     * @OGM\Property(type="int")
     */
    protected $user;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $leads;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $contacts;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $companies;

    /**
     * @var array|null
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $customers;

    /**
     * @return mixed
     */
    public function getAdvancedSettings()
    {
        return $this->advancedSettings;
    }

    /**
     * @param mixed $advancedSettings
     */
    public function setAdvancedSettings($advancedSettings): void
    {
        $this->advancedSettings = $advancedSettings;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param mixed $form
     */
    public function setForm($form): void
    {
        $this->form = $form;
    }

    /**
     * @return int|null
     */
    public function getUser(): ?int
    {
        return $this->user;
    }

    /**
     * @param int|null $user
     */
    public function setUser(?int $user): void
    {
        $this->user = $user;
    }

    /**
     * @return array|null
     */
    public function getLeads(): ?array
    {
        return $this->leads;
    }

    /**
     * @param array|null $leads
     */
    public function setLeads(?array $leads): void
    {
        $this->leads = $leads;
    }

    /**
     * @return array|null
     */
    public function getContacts(): ?array
    {
        return $this->contacts;
    }

    /**
     * @param array|null $contacts
     */
    public function setContacts(?array $contacts): void
    {
        $this->contacts = $contacts;
    }

    /**
     * @return array|null
     */
    public function getCompanies(): ?array
    {
        return $this->companies;
    }

    /**
     * @param array|null $companies
     */
    public function setCompanies(?array $companies): void
    {
        $this->companies = $companies;
    }

    /**
     * @return array|null
     */
    public function getCustomers(): ?array
    {
        return $this->customers;
    }

    /**
     * @param array|null $customers
     */
    public function setCustomers(?array $customers): void
    {
        $this->customers = $customers;
    }
}
