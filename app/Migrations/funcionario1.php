<?php

namespace App\Migrations;
use Illuminate\Database\Capsule\Manager as Capsule;

class Funcionario
{
    public function up()
    {
        Capsule::Schema::create('Funcionarios', function ($table) {
            $table->bigIncrements('id');
            $table->string("Nome");
            $table->enum("sexo", ["M", "F", "NB"]) ->nullable();
            $table->date("data_nascimento") -> nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Capsule::Schema::drop('Funcionarios');
    }

}
