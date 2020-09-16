<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Repositories\Tomato;

use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Hedera\Models\SharedCustomersServices;
use Hedera\Models\Tomato\TomatoTrackingInternetDocuments;

class TomatoObserverConfigsRepository extends BaseRepository
{
    /**
     * @param SharedCustomersServices $sharedCustomersServices
     * @return HederaCollection
     */
    public function loadObserverConfigsWithTrackingIDForSCS(SharedCustomersServices $sharedCustomersServices)
    {
        $scsGraph = last(explode('\\', SharedCustomersServices::class));
        $trackGraph = last(explode('\\', TomatoTrackingInternetDocuments::class));
        $graph = last(explode('\\', $this->getClassName()));

        $cql = 'MATCH (n:' . $scsGraph . ')<-[:TOMATO_SERVICE_IN]-(observer:' . $graph . ')-[:TOMATO_TRACK_ID_IN]->(track:' . $trackGraph . ')';
        $cql .= ' WHERE ID(n) = $id';
        $cql .= ' RETURN observer, track';

        $query = $this->entityManager->createQuery($cql);
        $query->setParameter('id', $sharedCustomersServices->getId());

        $query
            ->addEntityMapping('observer', $this->getClassName())
            ->addEntityMapping('track', TomatoTrackingInternetDocuments::class);

        return new HederaCollection($query->getResult());
    }
}
