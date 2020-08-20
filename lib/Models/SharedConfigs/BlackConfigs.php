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
use Hedera\Models\Black\BlackScheme;
use Hedera\Models\SharedConfigs;

/**
 * @OGM\Node(label="SharedConfigs", repository="Hedera\Repositories\SharedConfigsRepository")
 */
class BlackConfigs extends SharedConfigs
{
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
    protected $mode;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $entry;

    /**
     * @var BlackScheme|null
     *
     * @OGM\Relationship(type="BLACK_CONFIG_IN", direction="OUTGOING", collection=false, mappedBy="blackConfigs", targetEntity="Hedera\Models\Black\BlackScheme")
     */
    protected $blackScheme;

    /**
     * @var DianthusConfigs|null
     *
     * @OGM\Relationship(type="DIANTHUS_BLACKCONFIG", direction="OUTGOING", collection=false, mappedBy="blackConfigs", targetEntity="Hedera\Models\SharedConfigs\DianthusConfigs")
     */
    protected $dianthusConfigs;

    /**
     * @var BrunneraConfigs|null
     *
     * @OGM\Relationship(type="BRUNNERA_BLACKCONFIG", direction="OUTGOING", collection=false, mappedBy="blackConfigs", targetEntity="Hedera\Models\SharedConfigs\BrunneraConfigs")
     */
    protected $brunneraConfigs;

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
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     */
    public function setMode(string $mode): void
    {
        $this->mode = $mode;
    }

    /**
     * @return string
     */
    public function getEntry(): string
    {
        return $this->entry;
    }

    /**
     * @param string $entry
     */
    public function setEntry(string $entry): void
    {
        $this->entry = $entry;
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

    // linked hook for another services (binotel, phonet)

    /**
     * @return DianthusConfigs|null
     */
    public function getDianthusConfigs(): ?DianthusConfigs
    {
        return $this->dianthusConfigs;
    }

    /**
     * @param DianthusConfigs|null $dianthusConfigs
     */
    public function setDianthusConfigs(?DianthusConfigs $dianthusConfigs): void
    {
        $this->dianthusConfigs = $dianthusConfigs;
    }

    /**
     * @return BrunneraConfigs|null
     */
    public function getBrunneraConfigs(): ?BrunneraConfigs
    {
        return $this->brunneraConfigs;
    }

    /**
     * @param BrunneraConfigs|null $brunneraConfigs
     */
    public function setBrunneraConfigs(?BrunneraConfigs $brunneraConfigs): void
    {
        $this->brunneraConfigs = $brunneraConfigs;
    }
}
