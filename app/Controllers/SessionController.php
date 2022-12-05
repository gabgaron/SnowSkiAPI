<?php

namespace Controllers;

use Models\Services\SessionService;

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
    }

    public function insertSessions()
    {
        $test = $this->request->getParameters();
        echo (json_encode($test));
        SessionService::insertSession($test);
        die();
        //SessionService::insertSession();
    }
}