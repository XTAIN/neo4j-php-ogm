<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Repositories;

use Doctrine\Common\Collections\Collection;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;

class SharedModulesRepository extends BaseRepository
{
    /**
     * @param Collection $collection
     * @param string $classConfig
     * @return Collection<array>
     * @throws \Exception
     */
    public function loadConfigs(Collection $collection, string $classConfig)
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

        $query = $this->entityManager
            ->createQuery(
                'MATCH (n:' . $this->getClassName()
                . ') WHERE ID(n) IN $id MATCH (n)<-[:MODULE_CONFIG_IN]-(conf) RETURN n, conf'
            );
        $query->setParameter('id', $ids);
        $query
            ->addEntityMapping('n', $this->getClassName())
            ->addEntityMapping('conf', $classConfig);

        $result = $query->execute();

        return new HederaCollection($result);
    }
}
