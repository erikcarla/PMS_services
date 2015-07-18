<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MsuserSeeder extends Seeder {

    public function run()
    {
        DB::table('msuser')->delete();

        $user = app()->make('App\Model\MsUser');
        $hasher = app()->make('hash');

        $user->fill([
            'email' => 'admin@technocentrum.net',
            'password' => $hasher->make('admin'),
            'role_id' => 1
        ]); 
        $user->save();
    }

}

?>