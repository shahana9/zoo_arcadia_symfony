<?php

namespace App\Service;
use  App\Document\Avis;
use Doctrine\ODM\MongoDB\DocumentManager;

class AvisService
{

private  $documentManager;

public function __construct(DocumentManager $documentManager )
{
        $this->documentManager = $documentManager;
    
}

public function createAvis(string $nom, string $contenu)
{
        $avis = new Avis();
        $avis->setNom($nom);
        $avis->setContenu($contenu);

        $this->documentManager->persist($avis);
        $this->documentManager->flush();
}


public function getValidatedAvis()

{
         return $this->documentManager->getRepository(Avis::class)->findBy(['statut' => 'valide']);
}

}
