<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Modality extends Model {
    use CrudTrait;
    
    protected $table = 'modalities';
    protected $fillable = ['name'];
    public $timestamps = false;
}
