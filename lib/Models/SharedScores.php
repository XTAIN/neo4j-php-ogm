<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Models;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="SharedScores", repository="Hedera\Repositories\SharedScoresRepository")
 */
class SharedScores
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var SharedCustomersServices|null
     *
     * @OGM\Relationship(type="SCORE_IN", direction="OUTGOING", collection=false, targetEntity="SharedCustomersServices")
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
}
