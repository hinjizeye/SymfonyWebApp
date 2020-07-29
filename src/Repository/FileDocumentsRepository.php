<?php

namespace App\Repository;

use App\Entity\FileDocuments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FileDocuments|null find($id, $lockMode = null, $lockVersion = null)
 * @method FileDocuments|null findOneBy(array $criteria, array $orderBy = null)
 * @method FileDocuments[]    findAll()
 * @method FileDocuments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileDocumentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileDocuments::class);
    }

    // /**
    //  * @return FileDocuments[] Returns an array of FileDocuments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FileDocuments
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
