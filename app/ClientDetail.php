<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    protected $table = 'client_details';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
