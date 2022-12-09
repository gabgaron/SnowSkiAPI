<?php

namespace Models\Brokers;

use stdClass;

class DescentBroker extends Broker
{
    public function insertDescent(stdClass $descent, $sessionId)
    {
        $sql = "INSERT INTO descent (id_session, descent_number, duration, starting_altitude, finished_altitude)
            VALUES (?, ?, ?, ?, ?)";
        $this->query($sql, [
            $sessionId,
            $descent->descent_number,
            $descent->duration,
            $descent->starting_altitude,
            $descent->finished_altitude
        ]);
    }

    public function findDescents(int $sessionID): ?array
    {
        $sql = 'SELECT * FROM descent WHERE id_session = ?';
        return $this->select($sql, [
            $sessionID
        ]);
    }
}