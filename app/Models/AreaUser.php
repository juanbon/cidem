<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class AreaUser extends Model {
    use CrudTrait;
    
    protected $table = 'area_user';
    protected $fillable = ['area_id', 'user_id'];
    public $timestamps = false;
}
