<?php

use Doctrine\Common\Collections\Expr\Comparison;
use GraphAware\Neo4j\OGM\EntityManager;

require_once '../vendor/autoload.php';

$entityManager = EntityManager::create('http://neo4j:neo4jneo4j@localhost:7474');


$serv = new \Hedera\Services\SmartService($entityManager);
$serv->init('key_1');
$serv->clear();
//$mod = new \Hedera\Models\SharedApikeys();

//$mod->getSharedCustomersServices();

return;

//$person = new \App\Person();
//$person->setName('Jarvis3');
//$person->setBorn('345');
//
//$entityManager->persist($person);
//$entityManager->flush();
//
//
//echo $person->getId();

//$personsRepository = $entityManager->getRepository(\App\Models\Person::class);
//echo get_class($personsRepository);
$criteria = new \Doctrine\Common\Collections\Criteria();
$criteria->where(new Comparison('name', Comparison::EQ, 'Jarvis'));

//$persons = $personsRepository->findAll();
//echo count($persons);
/**
 * @var \App\Models\Person $person
 * */
//foreach ($persons as $person) {
//    echo sprintf("- %s\n", $person->getAnother());
//    print_r($person->getAnother());
////    $entityManager->remove($person, true);
////    $entityManager->flush();
//    return;
//    foreach ($person->getMovies() as $movie) {
//        echo sprintf("    -- %s\n", $movie->getTitle());
//    }
//}


$rep = $entityManager->getRepository(\Hedera\Models\SharedCustomersServices::class);

//$collect = $rep->findAll();
//
//foreach ($collect as $one) {
//    echo $one->getCode();
//    echo '_____';
//    $val = $one->getSharedPeriods();
////    echo $val ? json_encode($val->getPeriods()) : '==';
//
////    if ($val) {
////        echo $val->getKey();
////    }
////    foreach ($one->getSharedApikey() as $item) {
////        echo $item->getKey();
////    }
//}

//return;
$oth = new \Hedera\Models\SharedCustomersServices();
$oth2 = new \Hedera\Models\Tomato\TomatoTokensConfigs();

$rep2 = $entityManager->getRepository(\Hedera\Models\Tomato\TomatoTokensConfigs::class);

$col = $rep2->findAll();

foreach ($col as $item) {
    echo $item->getSharedCustomersServices()->getCode();
}

$oth2->setName('tomato');

$oth->setCode('code_tomato');
$oth->setActive(true);

$oth2->setSharedCustomersServices($oth);

//$entityManager->persist($oth2);
//$entityManager->persist($oth2);
//$entityManager->flush();
//$per = new \App\Models\Person();
//
//$per->setName('nname 55');
//$per->setAnother(['key' => 'value', 'key2' => ['deep' => ['val 1', 'val 2']]]);
//
//$entityManager->persist($per);

//$entityManager->flush();

//print_r( $per->getAnother());
