<?php

namespace App\Repository;

use App\Entity\KontratuaLote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KontratuaLote|null find($id, $lockMode = null, $lockVersion = null)
 * @method KontratuaLote|null findOneBy(array $criteria, array $orderBy = null)
 * @method KontratuaLote[]    findAll()
 * @method KontratuaLote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KontratuaLoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KontratuaLote::class);
    }

    public function getAllByProrroga()
    {
        $qb = $this->createQueryBuilder('k')
            ->orderBy(
                'GREATEST(COALESCE(k.fetxaIraupena,0),COALESCE(k.prorroga1,0), COALESCE(k.prorroga2,0), COALESCE(k.prorroga3,0) )', 'DESC'
            )
            ;

        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return KontratuaLote[] Returns an array of KontratuaLote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KontratuaLote
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
