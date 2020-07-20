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
use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Hedera\Models\SharedAmocrm;
use Hedera\Models\SharedIntegrations;
use Hedera\Models\SharedOauth;

class SharedAmocrmRepository extends BaseRepository
{
    /**
     * @param SharedAmocrm $sharedAmocrm
     * @param array $where ex.: [['oauth.code', '!=', 'tomato', 'OR'], ['integration.name', 'Teal']]
     * @return \Doctrine\Common\Collections\Collection
     */
    public function loadOAuthWithIntegration(SharedAmocrm $sharedAmocrm, array $where = [])
    {
        $graph = last(explode('\\', $this->getClassName()));

        $cql = 'MATCH (n:' . $graph . ') WHERE ID(n) = $id';
        $cql .= ' MATCH (n)<-[:AMOCRM_OAUTH_IN]-(oauth)-[:INTEGR_OAUTH_IN]->(integration)';

        if (!empty($where)) {
            $whereSql = '';
            foreach ($where as $value) {
                if (!is_array($value) || count($value) < 2) {
                    continue;
                }

                $key = $value[0];
                $operator = isset($value[2]) ? $value[1] : '=';
                $val = $value[2] ?? $value[1];
                $betweenOperator = $value[3] ?? 'AND';

                if (empty($whereSql)) {
                    $whereSql .= ' WHERE ';
                } else {
                    $whereSql .= " $betweenOperator ";
                }

                $whereSql .= "$key $operator '$val'";
            }

            $cql .= $whereSql;
        }

        $cql .= ' RETURN n, oauth, integration';

        $query = $this->entityManager->createQuery($cql);
        $query->setParameter('id', $sharedAmocrm->getId());

        $query
            ->addEntityMapping('n', $this->getClassName())
            ->addEntityMapping('oauth', SharedOauth::class)
            ->addEntityMapping('integration', SharedIntegrations::class);

        return new HederaCollection($query->getResult());
    }
}
