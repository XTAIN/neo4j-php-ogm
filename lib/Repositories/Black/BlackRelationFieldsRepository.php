<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Repositories\Black;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Hedera\Models\SharedIntermediaries;

class BlackRelationFieldsRepository extends BaseRepository
{
    /**
     * @param Collection $collection
     * @return Collection<array>
     * @throws \Exception
     */
    public function loadRelationsWithIntermediary(Collection $collection)
    {
        if ($collection->isEmpty()) {
            return new HederaCollection();
        }

        $ids = $collection
            ->map(
                function ($item) {
                    return $item->getId();
                }
            )
            ->getValues();

        $graph = last(explode('\\', $this->getClassName()));

        $query = $this->entityManager
            ->createQuery(
                'MATCH (n:' . $graph . ') WHERE ID(n) IN $id MATCH (n)-[:INTERMEDIA_FIELD_IN]->(intermediary) RETURN n, intermediary'
            );
        $query->setParameter('id', $ids);
        $query
            ->addEntityMapping('n', $this->getClassName())
            ->addEntityMapping('intermediary', SharedIntermediaries::class);

        $result = $query->execute();

        return new HederaCollection($result);
    }
}
