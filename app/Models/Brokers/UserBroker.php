<?php

namespace Models\Brokers;

use stdClass;
use Zephyrus\Security\Cryptography;

class UserBroker extends Broker
{
    public function findByUsername(string $username): ?stdClass
    {
        $sql = 'SELECT * FROM "user" where username = ?;';
        return $this->selectSingle($sql, [$username]);
    }

    public function findByID(int $id): ?array
    {
        $sql = '
        select * from session s
        left join region r on s.id = r.id_session
        left join descent d on s.id = d.id_session
        where s.id_user = ?;';
        return $this->select($sql, [$id]);
    }

    public function createAccount(array $user): ?int
    {
        $sql = '
        INSERT INTO "user"(username, password)
        VALUES (?, ?) RETURNING id;
        ';
        return $this->selectSingle($sql, [
            $user["username"],
            Cryptography::hashPassword($user["password"])
        ])->id;
    }
}