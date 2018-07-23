<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class FinancingType extends Model {
    use CrudTrait;
    
    protected $table = 'financing_types';
    protected $fillable = ['name'];
    public $timestamps = false;
}
