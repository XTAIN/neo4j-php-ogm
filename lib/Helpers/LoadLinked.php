<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2021 Fabrika-Klientov
 * @version   GIT: 21.03.02
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Helpers;

use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;

trait LoadLinked
{
    /**
     * @param int|mixed $parent
     * @param string $linkedClass
     * @return HederaCollection
     */
    public function loadLinkedIds($parent, string $linkedClass)
    {
        if (is_object($parent) && method_exists($parent, 'getId')) {
            $parent = $parent->getId();
        }

        if (empty($parent) || !is_int($parent) || empty($linkedClass) || !class_exists($linkedClass)) {
            return new HederaCollection();
        }

        $graph = last(explode('\\', $this->getClassMetadata()->getLabel()));
        $linkedGraph = last(explode('\\', $linkedClass));

        $cql = 'MATCH (n:' . $graph . ')-[]-(m:' . $linkedGraph . ') WHERE ID(n) = $id RETURN ID(m)';

        $query = $this->entityManager->createQuery($cql);
        $query->setParameter('id', (int)$parent);

        $result = $query->getResult();

        return new HederaCollection(
            array_map(
                function ($item) {
                    return $item['ID(m)'];
                },
                $result
            )
        );
    }
}
