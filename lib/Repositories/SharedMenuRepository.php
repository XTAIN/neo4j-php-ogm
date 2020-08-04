<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Repositories;

use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use GraphAware\Neo4j\OGM\Query;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Hedera\Relations\SubMenu;

class SharedMenuRepository extends BaseRepository
{

    public function loadToConvert()
    {
        $graph = last(explode('\\', $this->getClassName()));

        $cqlRel = 'MATCH (n:' . $graph . ')-[:SUB_MENU]->(d) RETURN n, d';
        $cqlWithoutRel = 'MATCH (n:' . $graph . ') WHERE NOT (n)-[:SUB_MENU]->() AND NOT (n)<-[:SUB_MENU]-() RETURN n';

        $queryRel = $this->entityManager->createQuery($cqlRel);
        $queryWithoutRel = $this->entityManager->createQuery($cqlWithoutRel);

        $queryRel
            ->addEntityMapping('n', $this->getClassName())
            ->addEntityMapping('d', $this->getClassName());

        $queryWithoutRel
            ->addEntityMapping('n', $this->getClassName());

        $resultRel = new HederaCollection($queryRel->getResult());
        $resultWithoutRel = new HederaCollection($queryWithoutRel->getResult());

        $resultWithoutRel = $resultWithoutRel->map(function ($item) {
            return ['n' => $item];
        });

        return new HederaCollection(array_merge($resultRel->getValues(), $resultWithoutRel->getValues()));
    }
}
