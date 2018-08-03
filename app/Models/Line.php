<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Line extends Model {
    use CrudTrait;
    
    protected $table = 'lines';
//    protected $fillable = ['name','name2','institucion', 'modality_id', 'dead_line', 'description', 'financing_type_id', 'info', 'web', 'is_enabled'];
  
    protected $fillable = ['name','institucion', 'modality_id', 'dead_line', 'description', 'financing_type_id', 'info', 'web', 'is_enabled'];

    public function modality() {
        return $this->belongsTo('App\Models\Modality');
    }
    
    public function financingType() {
        return $this->belongsTo('App\Models\FinancingType');
    }
    
    public function recipients() {
        return $this->belongsToMany('App\Models\Recipient');
    }
    
    public function areas() {
        return $this->belongsToMany('App\Models\Area');
    }
}
