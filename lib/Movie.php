<?php

namespace App;

use GraphAware\Neo4j\OGM\Annotations as OGM;
use GraphAware\Neo4j\OGM\Common\Collection;

/**
 *
 * @OGM\Node(label="Movie")
 */
class Movie
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $title;

    /**
     * @var Person[]|Collection
     *
     * @OGM\Relationship(type="ACTED_IN", direction="INCOMING", collection=true, mappedBy="movies", targetEntity="Person")
     */
    protected $actors;

    public function __construct()
    {
        $this->actors = new Collection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $tagline;

    /**
     * @var int
     *
     * @OGM\Property(type="int")
     */
    protected $released;

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Person[]|Collection
     */
    public function getActors()
    {
        return $this->actors;
    }
}
