<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * */

namespace GraphAware\Neo4j\OGM\Listeners;

use GraphAware\Neo4j\Client\Event\FailureEvent;
use GraphAware\Neo4j\Client\Event\PostRunEvent;
use GraphAware\Neo4j\Client\Event\PreRunEvent;

class HederaListener
{
    /**
     * @param PreRunEvent $event
     */
    public function onPreRun(PreRunEvent $event)
    {
    }

    /**
     * @param PostRunEvent $event
     */
    public function onPostRun(PostRunEvent $event)
    {
    }

    /**
     * @param FailureEvent $event
     */
    public function onFailure(FailureEvent $event)
    {
    }
}
