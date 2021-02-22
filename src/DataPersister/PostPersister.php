<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Statistic;
use App\Entity\Teachr;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class PostPersister implements DataPersisterInterface
{
    private $entityManagerInterface;
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    public function supports($data): bool
    {
        return $data instanceof Teachr;
    }

    public function persist($data)
    {
        $data->setCreatedAt(new \DateTime());
        $this->entityManagerInterface->persist($data);
        $count = $this->entityManagerInterface->getRepository(Statistic::class)->findOneBy([], ['id' => 'DESC']);
        $count->setCount($count->getCount() + 1);
        $this->entityManagerInterface->persist($count);
        $this->entityManagerInterface->flush();
    }

    public function remove($data)
    {
    }
}
