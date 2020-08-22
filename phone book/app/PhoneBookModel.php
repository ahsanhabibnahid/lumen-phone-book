<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneBookModel extends Model
{
    protected $table = "phn_book_details";
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = "int";
    public  $timestamps = false;
}
