<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Tomato;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Models\SharedCustomersServices;

/**
 * @OGM\Node(label="TomatoCitiesConfigs", repository="Hedera\Repositories\Tomato\TomatoCitiesConfigsRepository")
 */
class TomatoCitiesConfigs
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $lead;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $customer;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $contact;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $company;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="TOMATO_CITY_SERVICE_IN", direction="OUTGOING", collection=false, targetEntity="Hedera\Models\SharedCustomersServices")
     */
    protected $sharedCustomersServices;

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
     * @return mixed
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * @param mixed $lead
     */
    public function setLead($lead): void
    {
        $this->lead = $lead;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company): void
    {
        $this->company = $company;
    }

    /**
     * @return SharedCustomersServices|null
     */
    public function getSharedCustomersServices(): ?SharedCustomersServices
    {
        return $this->sharedCustomersServices;
    }

    /**
     * @param SharedCustomersServices|null $sharedCustomersServices
     */
    public function setSharedCustomersServices(?SharedCustomersServices $sharedCustomersServices): void
    {
        $this->sharedCustomersServices = $sharedCustomersServices;
    }
}
