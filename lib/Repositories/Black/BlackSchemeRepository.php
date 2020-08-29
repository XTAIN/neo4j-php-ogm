<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.08.29
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Repositories\Black;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Hedera\Models\Black\BlackRelationFields;

class BlackSchemeRepository extends BaseRepository
{
    /**
     * @param Collection $collection
     * @return Collection<array>
     * @throws \Exception
     */
    public function loadSchemeWithRelationFields(Collection $collection)
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
                'MATCH (n:' . $graph . ') WHERE ID(n) IN $id MATCH (n)<-[:BLACK_RELATION_IN]-(relation) RETURN n, relation'
            );
        $query->setParameter('id', $ids);
        $query
            ->addEntityMapping('n', $this->getClassName())
            ->addEntityMapping('relation', BlackRelationFields::class);

        $result = $query->execute();

        return new HederaCollection($result);
    }
}
