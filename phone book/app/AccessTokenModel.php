<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessTokenModel extends Model
{
    protected $table = "access_token";
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = "int";
    public  $timestamps = false;
}
