<?php

namespace Controllers;

use Models\Services\SessionService;
use stdClass;

class SessionController extends \Zephyrus\Security\Controller
{

    /**
     * FORMAT
     * {
    "id_user" : 1,
    "duration": 20,
    "highest_altitude": 15.5,
    "lowest_altitude": 15.5,
    "date": 1111,
    "region": {
    "center_lat": 46.5555,
    "center_long": -73.555
    },
    "descents": [
    {
    "descent_number": 1,
    "duration": 20,
    "highest_altitude": 25.5,
    "lowest_altitude": 25.5
    },
    {
    "descent_number": 2,
    "duration": 20,
    "highest_altitude": 25.5,
    "lowest_altitude": 25.5
    },
    {
    "descent_number": 3,
    "duration": 20,
    "highest_altitude": 25.5,
    "lowest_altitude": 25.5
    },
    {
    "descent_number": 4,
    "duration": 20,
    "highest_altitude": 25.5,
    "lowest_altitude": 25.5
    },
    {
    "descent_number": 5,
    "duration": 20,
    "highest_altitude": 25.5,
    "lowest_altitude": 25.5
    }
    ]
    }
     */
    public function initializeRoutes()
    {
        $this->post("/session", "insertSessions");
        $this->get("/session/{id}", "getSessions");
    }

    public function insertSessions()
    {
        $params = $this->request->getParameters();
        echo (json_encode($params));
        SessionService::insertSession($params);
    }
    public function getSessions(int $id)
    {
        $user = new stdClass();
        $sessions = SessionService::findSessions($id);
        $user->userID = $id;
        $user->sessions = $sessions;
        echo json_encode($user);
    }
}