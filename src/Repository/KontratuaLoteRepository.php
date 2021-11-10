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

    public function bilaketa($myFilters)
    {
        $qb = $this->createQueryBuilder('a');
        $andStatements = $qb->expr()->andX();
        if ( count($myFilters) === 0 ) {
            return $qb->getQuery()->getResult();
        }

        foreach ($myFilters as $key=>$value) {
            // begiratu espazioak dituen
            foreach ($value as $i => $iValue) {
                $searchTerms = explode('+', $iValue );
                foreach ($searchTerms as $k => $val) {
                    if (strpos($val,"\"") !== false ){
                        $val = str_replace("\"", '', $val);
                        /**********************************************************************************************/
                        /**********************************************************************************************/
                        /**********************************************************************************************/
                        // % % kendu bilaketa zehatza egin dezan. Clarak eskatuta.
                        // $andStatements->add($qb->expr()->like("REPLACE(a.$key,',','')", $qb->expr()->literal('%' . trim($val) . '%')));
                        $andStatements->add($qb->expr()->like("REPLACE(a.$key,',','')", $qb->expr()->literal(trim($val))));
                        /**********************************************************************************************/
                        /**********************************************************************************************/
                        /**********************************************************************************************/
                    } else {
                        $andStatements->add(
                            $qb->expr()->like("a.$key", $qb->expr()->literal('%' . trim($val) . '%'))
                        );
                    }
                }
            }
        }
        $qb->andWhere($andStatements);


        dump($qb->getQuery()->getSQL());

        return $qb->getQuery()->getResult();
    }
}
