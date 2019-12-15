<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = 'expenses';
    protected $fillable = ['amount', 'users_id', 'created_date'];
    public $timestamps = false;
}
