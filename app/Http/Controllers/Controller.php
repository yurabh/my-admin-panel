<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OAT;

#[OAT\Info(
    version: "1.0.0",
    description: "API documentation for the Admin Panel",
    title: "Admin Panel API Documentation"
)]
#[OAT\Server(url: 'http://localhost:8080', description: "Local Server")]
#[OAT\PathItem(path: "/api/admin")]
abstract class Controller
{

}
