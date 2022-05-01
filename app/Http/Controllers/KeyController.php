<?php

namespace App\Http\Controllers;

use Faker\Generator;
use Illuminate\Container\Container;

use Illuminate\Http\Request;

class KeyController extends Controller
{
    public function __construct(
        private Request $request,
        private Generator $faker,
    ) {
        $this->faker = Container::getInstance()->make(Generator::class);
    }
    public function generatePrivateKey()
    {
        if (!$this->request->ajax())
            return abort(404);
        $privateKey = $this->faker->words(10,true);
        return $privateKey;
    }
    public function updateDBURL()
    {
        if (!$this->request->ajax())
            return abort(404);
    }
}
