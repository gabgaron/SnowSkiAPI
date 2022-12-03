<?php

namespace Models\Brokers;

use stdClass;

class SessionBroker extends Broker
{
    public function insertSession(array $session): ?int
    {
        $sql = '
        INSERT INTO session(id_user, duration, highest_altitude, lowest_altitude, date)
        VALUES (?, ?, ?, ? ,?) returning id
        ';
        return $this->selectSingle($sql, [
            $session["id_user"],
            $session["duration"],
            $session["highest_altitude"],
            $session["lowest_altitude"],
            $session["date"]
        ])->id;
    }

    public function findSessions(int $userID): ?array
    {
        $sql = "SELECT * FROM session where id_user = ?";
        return $this->select($sql, [
            $userID
        ]);
    }
}