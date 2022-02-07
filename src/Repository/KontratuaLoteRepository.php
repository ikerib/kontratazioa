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
            ->select('k','l','m')
            ->innerJoin('k.kontratua', 'l')
            ->innerJoin('l.mota', 'm')
            ->orderBy(
                'GREATEST(COALESCE(k.fetxaIraupena,0),COALESCE(k.prorroga1,0), COALESCE(k.prorroga2,0), COALESCE(k.prorroga3,0) )', 'DESC'
            )
            ;

        return $qb->getQuery()->getResult();
    }

    public function bilaketa($myFilters)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a', 'k');
        $qb->innerJoin('a.kontratua', 'k');
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
        $qb->orderBy('a.id', 'DESC');

        return $qb->getQuery()->getResult();
    }

    public function getAllSortedBySaila($myFilters)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->select('a', 'k');
        $qb->innerJoin('a.kontratua', 'k');
        $andStatements = $qb->expr()->andX();
        if ( count($myFilters) === 0 ) {
            $qb->orderBy('k.saila', 'ASC');
            return $qb->getQuery()->getResult();
        }
        foreach ($myFilters as $key=>$value) {
            // begiratu espazioak dituen
            if ( $key === "kontratista" ) {
                $qb->innerJoin('a.kontratista', 'kontratista');
                $qb->andWhere('kontratista.id=:kontratistaID')->setParameter('kontratistaID', $value[0]);
            } else {
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
        }
        $qb->andWhere($andStatements);
        $qb->orderBy('a.id', 'DESC');

        return $qb->getQuery()->getResult();
    }
}
