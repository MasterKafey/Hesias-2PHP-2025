<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findByNames(string $firstname, string $lastname)
    {
        $query = $this->createQueryBuilder('user');

        $query->where(
            $query->expr()->orX(
                $query->expr()->eq('user.firstname', ':firstname'),
                $query->expr()->eq('user.lastname', ':lastname')
            )
        );

        return $query->getQuery()->getResult();
    }
}
