<?php

namespace Models\Services;

use Models\Brokers\DescentBroker;
use Models\Brokers\RegionBroker;
use Models\Brokers\SessionBroker;
use stdClass;

class SessionService
{
    public static function insertSession(array $session)
    {
        $sessionID = (new SessionBroker())->insertSession($session);
        (new RegionBroker())->insertRegion($session["region"], $sessionID);
        $descentBroker = new DescentBroker();
        foreach ($session["descents"] as $descent) {
            $descentBroker->insertDescent($descent, $sessionID);
        }
    }

    public static function findSessions(int $userId): ?array
    {
        $sessions = (new SessionBroker())->findSessions($userId);
        $userSessions = [];
        $descentBroker = new DescentBroker();
        $regionBroker = new RegionBroker();
        foreach ($sessions as $session) {
            $session->region = $regionBroker->findRegion($session->id);
            $session->descents = $descentBroker->findDescents($session->id);
            array_push($userSessions, $session);
        }
        return $userSessions;
    }
}