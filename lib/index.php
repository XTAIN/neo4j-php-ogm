<?php

use GraphAware\Neo4j\OGM\EntityManager;

require_once '../vendor/autoload.php';

$entityManager = EntityManager::create('http://neo4j:neo4jneo4j@localhost:7474');



$person = new \App\Person();
$person->setName('Jarvis3');
$person->setBorn('345');

$entityManager->persist($person);
$entityManager->flush();


echo $person->getId();
