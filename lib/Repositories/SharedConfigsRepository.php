<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.07
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Repositories;

use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Hedera\Helpers\LoadLinked;
use Hedera\Models\SharedConfigs;

class SharedConfigsRepository extends BaseRepository
{
    use LoadLinked;

    /**
     * @deprecated DONT WORK (RETURNED PARENT ENTITY if parent loaded before)
     * @param SharedConfigs|int $configs
     * @param string $classDeep (extends of SharedConfigs)
     * @return mixed
     */
    public function loadDeepConfigs($configs, string $classDeep)
    {
        if (is_object($configs) && $configs instanceof SharedConfigs) {
            $configs = $configs->getId();
        }

        if (empty($configs)) {
            return null;
        }

        $graph = last(explode('\\', SharedConfigs::class));

        $cql = 'MATCH (n:' . $graph . ') WHERE ID(n) = $id RETURN n';

        $query = $this->entityManager->createQuery($cql);
        $query->setParameter('id', (int)$configs);
        $query->addEntityMapping('n', $classDeep);

        return $query->getOneResult();
    }
}
