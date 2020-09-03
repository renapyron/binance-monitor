<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 9/3/20
 * Time: 12:50 AM
 */

namespace App\Models;


class Endpoint
{
    public $endpoint;
    public $method;

    public function __construct($endpoint, $method)
    {
        $this->endpoint = $endpoint;
        $this->method = $method;
    }
}