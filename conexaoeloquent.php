<?php

namespace App\Migrations;

require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$config = [

    "driver" => "mysql",
    "host" => "localhost",
    "database" => "atareu",
    "username" => "root",
    "username" => "",

    "charset" => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix" => ""
];

$capsule -> addConnection($config);
$capsule -> setAsGlobal();
$capsule -> bootEloquent();

$fun = new Funcionario;
$fun -> down();