<?php

namespace Models\Brokers;

use stdClass;

class RegionBroker extends Broker
{
    public function insertRegion(stdClass $region, int $sessionID)
    {
        $sql = "INSERT INTO region(id_session, center_lat, center_long) values (?, ?, ?)";
        $this->query($sql, [
            $sessionID,
            $region->center_lat,
            $region->center_long
        ]);
    }

    public function findRegion(int $sessionID): ?stdClass
    {
        $sql = 'SELECT * FROM region where id_session = ?';
        return $this->selectSingle($sql, [
            $sessionID
        ]);
    }
}