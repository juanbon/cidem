<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Area extends Model {
    use CrudTrait;
    
    protected $table = 'areas';
    protected $fillable = ['name'];
    public $timestamps = false;
}
