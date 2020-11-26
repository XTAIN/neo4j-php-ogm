<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.11.23
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Repositories;

use GraphAware\Neo4j\OGM\Repository\BaseRepository;
use Hedera\Helpers\WithBuilder;

class StateCustomersServicesRepository extends BaseRepository
{
    use WithBuilder;
}
