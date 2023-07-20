<?php

class VipRestClass {
    public function __construct()
    {
        $this->initialize();
    }

    private function initialize()
    {
        register_rest_route("/vip/v1" , "members" , [
            "methods" => WP_REST_Server::READABLE,
            "callback" => function() {
                return [
                    "success" => true
                ];
            }
        ]);
    }
}