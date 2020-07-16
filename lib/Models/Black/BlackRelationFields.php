<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models\Black;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use Hedera\Models\SharedIntermediaries;

/**
 * @OGM\Node(label="BlackRelationFields", repository="Hedera\Repositories\Black\BlackRelationFieldsRepository")
 */
class BlackRelationFields
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
    protected $enterItem;

    /**
     * @var mixed
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $intermediaryItem;

    /**
     * @var BlackScheme|null
     *
     * @OGM\Relationship(type="BLACK_RELATION_IN", direction="OUTGOING", collection=false, mappedBy="blackRelationFields", targetEntity="BlackScheme")
     */
    protected $blackScheme;

    /**
     * @var SharedIntermediaries|null
     *
     * @OGM\Relationship(type="INTERMEDIA_FIELD_IN", direction="OUTGOING", collection=false, targetEntity="Hedera\Models\SharedIntermediaries")
     */
    protected $sharedIntermediaries;

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
    public function getEnterItem()
    {
        return $this->enterItem;
    }

    /**
     * @param mixed $enterItem
     */
    public function setEnterItem($enterItem): void
    {
        $this->enterItem = $enterItem;
    }

    /**
     * @return mixed
     */
    public function getIntermediaryItem()
    {
        return $this->intermediaryItem;
    }

    /**
     * @param mixed $intermediaryItem
     */
    public function setIntermediaryItem($intermediaryItem): void
    {
        $this->intermediaryItem = $intermediaryItem;
    }

    /**
     * @return BlackScheme|null
     */
    public function getBlackScheme(): ?BlackScheme
    {
        return $this->blackScheme;
    }

    /**
     * @param BlackScheme|null $blackScheme
     */
    public function setBlackScheme(?BlackScheme $blackScheme): void
    {
        $this->blackScheme = $blackScheme;
    }

    /**
     * @return SharedIntermediaries|null
     */
    public function getSharedIntermediaries(): ?SharedIntermediaries
    {
        return $this->sharedIntermediaries;
    }

    /**
     * @param SharedIntermediaries|null $sharedIntermediaries
     */
    public function setSharedIntermediaries(?SharedIntermediaries $sharedIntermediaries): void
    {
        $this->sharedIntermediaries = $sharedIntermediaries;
    }
}
