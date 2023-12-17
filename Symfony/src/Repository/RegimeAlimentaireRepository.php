<?php

namespace App\Repository;

use App\Entity\RegimeAlimentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RegimeAlimentaire>
 *
 * @method RegimeAlimentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegimeAlimentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegimeAlimentaire[]    findAll()
 * @method RegimeAlimentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegimeAlimentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegimeAlimentaire::class);
    }

    public function save(RegimeAlimentaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RegimeAlimentaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RegimeAlimentaire[] Returns an array of RegimeAlimentaire objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RegimeAlimentaire
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
