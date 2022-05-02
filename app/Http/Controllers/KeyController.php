<?php

namespace App\Http\Controllers;

use Faker\Generator;
use Illuminate\Container\Container;
use \Illuminate\Encryption\Encrypter;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class KeyController extends Controller
{
    public function __construct(
        private Request $request,
        private Generator $faker,
        private Encrypter $encrypter,
    ) {
        $this->faker = Container::getInstance()->make(Generator::class);
    }
    public function generatePrivateKey()
    {
        if (!$this->request->ajax())
            return abort(404);
        $privateKey = $this->faker->words(10, true);
        return $privateKey;
    }

    public function updateDBURL()
    {
        if (!$this->request->ajax())
            return abort(404);
        $this->request->validate([
            'private_key' => 'required|min:32',
            'db_url' => 'required|url',
        ]);
        $privateKey = estString($this->request->private_key);
        $encryptPrivateKey = new $this->encrypter($privateKey, config('app.cipher'));
        $encryptURLDB = $encryptPrivateKey->encrypt($this->request->db_url);
        $decryptURLDB = $encryptPrivateKey->decrypt($encryptURLDB);
        dd($encryptURLDB, $decryptURLDB);
    }
}
