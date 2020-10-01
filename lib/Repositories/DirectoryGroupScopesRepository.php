<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.09.28
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Repositories;

use GraphAware\Neo4j\OGM\Common\Collection as HederaCollection;
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Hedera\Models\SharedScopes;

class DirectoryGroupScopesRepository extends BaseRepository
{
    /**
     * @return HederaCollection $item [n => DirectoryGroupScopes, scopes => HederaCollection<SharedScopes>]
     */
    public function loadGroupWithScopes()
    {
        $graph = last(explode('\\', $this->getClassName()));

        $cqlRel = 'MATCH (n:' . $graph . ')<-[:SHARED_SCOPES_TO_DIRECTORY_GROUP_SCOPES]-(scopes) RETURN n, scopes';
        $cqlWithoutRel = 'MATCH (n:' . $graph . ') WHERE NOT (n)<-[:SHARED_SCOPES_TO_DIRECTORY_GROUP_SCOPES]-() RETURN n';

        $queryRel = $this->entityManager->createQuery($cqlRel);
        $queryWithoutRel = $this->entityManager->createQuery($cqlWithoutRel);

        $queryRel
            ->addEntityMapping('n', $this->getClassName())
            ->addEntityMapping('scopes', SharedScopes::class);

        $queryWithoutRel
            ->addEntityMapping('n', $this->getClassName());

        $groupedRel = array_reduce(
            $queryRel->getResult(),
            function ($result, $item) {
                $exist = head(
                    array_filter(
                        $result,
                        function ($one) use ($item) {
                            return $one['n']->getId() == $item['n']->getId();
                        }
                    )
                );

                if (empty($exist)) {
                    $result[] = ['n' => $item['n'], 'scopes' => new HederaCollection([$item['scopes']])];
                } else {
                    $exist['scopes']->add($item['scopes']);
                }

                return $result;
            },
            []
        );

        $resultRel = new HederaCollection($groupedRel);
        $resultWithoutRel = new HederaCollection($queryWithoutRel->getResult());

        $resultWithoutRel = $resultWithoutRel->map(
            function ($item) {
                return ['n' => $item, 'scopes' => new HederaCollection()];
            }
        );

        return new HederaCollection(array_merge($resultRel->getValues(), $resultWithoutRel->getValues()));
    }
}
