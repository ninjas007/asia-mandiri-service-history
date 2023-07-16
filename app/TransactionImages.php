<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionImages extends Model
{
    protected $fillable = ['uniq_string', 'file_id', 'file_name'];
}
