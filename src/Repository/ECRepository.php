<?php

namespace App\Repository;

use App\Entity\EC;
use App\Entity\Teacher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EC>
 */
class ECRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EC::class);
    }

    public function countStudentsByTeacherAndStatus(Teacher $teacher, string $status): int
    {
        $qb = $this->createQueryBuilder('ec')
            ->select('COUNT(DISTINCT s.id)')
            ->join('ec.noteCcTps', 'nct')
            ->join('nct.student', 's')
            ->where('ec.teacher = :teacher')
            ->setParameter('teacher', $teacher);

        if ($status === 'passed') {
            $qb->andWhere('(nct.cc + COALESCE(nct.tp, 0)) / (CASE WHEN nct.hasTp = true THEN 2 ELSE 1 END) >= :passingGrade')
               ->setParameter('passingGrade', 10); // Assuming 10 is the passing grade
        } elseif ($status === 'failed') {
            $qb->andWhere('(nct.cc + COALESCE(nct.tp, 0)) / (CASE WHEN nct.hasTp = true THEN 2 ELSE 1 END) < :passingGrade')
               ->setParameter('passingGrade', 10);
        }

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function countStudentsByTeacher(Teacher $teacher): int
    {
        return $this->createQueryBuilder('ec')
            ->select('COUNT(DISTINCT s.id)')
            ->join('ec.noteCcTps', 'nct')
            ->join('nct.student', 's')
            ->where('ec.teacher = :teacher')
            ->setParameter('teacher', $teacher)
            ->getQuery()
            ->getSingleScalarResult();
    }
    //    /**
    //     * @return EC[] Returns an array of EC objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EC
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
