<?php

use Doctrine\Common\Collections\Expr\Comparison;
use GraphAware\Neo4j\OGM\EntityManager;

require_once '../vendor/autoload.php';

$entityManager = EntityManager::create('http://neo4j:neo4jneo4j@localhost:7474');



//$person = new \App\Person();
//$person->setName('Jarvis3');
//$person->setBorn('345');
//
//$entityManager->persist($person);
//$entityManager->flush();
//
//
//echo $person->getId();

$personsRepository = $entityManager->getRepository(\App\Person::class);

$criteria = new \Doctrine\Common\Collections\Criteria();
$criteria->where(new Comparison('name', Comparison::EQ, 'Jarvis'));

$persons = $personsRepository->findAll();

foreach ($persons as $person) {
    echo sprintf("- %s\n", $person->getName());

    foreach ($person->getMovies() as $movie) {
        echo sprintf("    -- %s\n", $movie->getTitle());
    }
}
