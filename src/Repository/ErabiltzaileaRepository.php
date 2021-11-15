<?php

namespace App\Repository;

use App\Entity\Erabiltzailea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Erabiltzailea|null find($id, $lockMode = null, $lockVersion = null)
 * @method Erabiltzailea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Erabiltzailea[]    findAll()
 * @method Erabiltzailea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ErabiltzaileaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Erabiltzailea::class);
    }

    // /**
    //  * @return Erabiltzailea[] Returns an array of Erabiltzailea objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Erabiltzailea
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
