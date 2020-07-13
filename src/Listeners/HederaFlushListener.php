<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * */

namespace GraphAware\Neo4j\OGM\Listeners;

use GraphAware\Neo4j\OGM\Event\OnFlushEventArgs;
use GraphAware\Neo4j\OGM\Event\PostFlushEventArgs;
use GraphAware\Neo4j\OGM\Event\PreFlushEventArgs;

class HederaFlushListener
{
    /**
     * @param PreFlushEventArgs $event
     */
    public function preFlush(PreFlushEventArgs $event)
    {
    }

    /**
     * @param PostFlushEventArgs $event
     */
    public function postFlush(PostFlushEventArgs $event)
    {
    }

    /**
     * @param OnFlushEventArgs $event
     */
    public function onFlush(OnFlushEventArgs $event)
    {
    }
}
