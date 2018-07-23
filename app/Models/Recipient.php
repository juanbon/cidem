<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Recipient extends Model {
    use CrudTrait;
    
    protected $table = 'recipients';
    protected $fillable = ['name'];
    public $timestamps = false;
}
