<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class AreaLine extends Model {
    use CrudTrait;
    
    protected $table = 'area_line';
    protected $fillable = ['line_id', 'area_id'];
    public $timestamps = false;
}
