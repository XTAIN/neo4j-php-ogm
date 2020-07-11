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
use Hedera\Helpers\EntityFactory;
use Hedera\Helpers\SerializationHelper;
use Hedera\Models\SharedCustomersServices;

/**
 * @OGM\Node(label="TomatoFieldRatio", repository="Hedera\Repositories\Tomato\TomatoFieldRatioRepository")
 */
class TomatoFieldRatio implements \JsonSerializable
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
    protected $code;

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
    protected $typeNPField;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $separator;

    /**
     * @var array
     *
     * @OGM\Property(type="array")
     * @OGM\Convert(type="nested")
     */
    protected $typesFiledAmo;

    /**
     * @var mixed|null
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $amoField;

    /**
     * @var mixed|null
     *
     * @OGM\Property(type="array", nullable=true)
     * @OGM\Convert(type="nested")
     */
    protected $relatedChildren;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $statusMessage;

    /**
     * @var string|null
     *
     * @OGM\Property(type="string", nullable=true)
     */
    protected $codeWarn;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="TOMATO_SERVICE_IN", direction="OUTGOING", collection=false, targetEntity="Hedera\Models\SharedCustomersServices")
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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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
    public function getTypeNPField(): string
    {
        return $this->typeNPField;
    }

    /**
     * @param string $typeNPField
     */
    public function setTypeNPField(string $typeNPField): void
    {
        $this->typeNPField = $typeNPField;
    }

    /**
     * @return string|null
     */
    public function getSeparator(): ?string
    {
        return $this->separator;
    }

    /**
     * @param string|null $separator
     */
    public function setSeparator(?string $separator): void
    {
        $this->separator = $separator;
    }

    /**
     * @return array
     */
    public function getTypesFiledAmo(): array
    {
        return $this->typesFiledAmo;
    }

    /**
     * @param array $typesFiledAmo
     */
    public function setTypesFiledAmo(array $typesFiledAmo): void
    {
        $this->typesFiledAmo = $typesFiledAmo;
    }

    /**
     * @return mixed|null
     */
    public function getAmoField()
    {
        return $this->amoField;
    }

    /**
     * @param mixed|null $amoField
     */
    public function setAmoField($amoField): void
    {
        $this->amoField = $amoField;
    }

    /**
     * @return mixed|null
     */
    public function getRelatedChildren()
    {
        return $this->relatedChildren;
    }

    /**
     * @param mixed|null $relatedChildren
     */
    public function setRelatedChildren($relatedChildren): void
    {
        $this->relatedChildren = $relatedChildren;
    }

    /**
     * @return string|null
     */
    public function getStatusMessage(): ?string
    {
        return $this->statusMessage;
    }

    /**
     * @param string|null $statusMessage
     */
    public function setStatusMessage(?string $statusMessage): void
    {
        $this->statusMessage = $statusMessage;
    }

    /**
     * @return string|null
     */
    public function getCodeWarn(): ?string
    {
        return $this->codeWarn;
    }

    /**
     * @param string|null $codeWarn
     */
    public function setCodeWarn(?string $codeWarn): void
    {
        $this->codeWarn = $codeWarn;
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

    public function jsonSerialize()
    {
        return self::serializing();
    }
}
