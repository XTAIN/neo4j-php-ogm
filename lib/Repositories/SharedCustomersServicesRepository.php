<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.06
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Repositories;

use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Hedera\Helpers\LoadLinked;
use Hedera\Helpers\WithBuilder;

class SharedCustomersServicesRepository extends BaseRepository
{
    use WithBuilder;
    use LoadLinked;
}
