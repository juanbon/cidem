<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class LineRecipient extends Model {
    use CrudTrait;
    
    protected $table = 'line_recipient';
    protected $fillable = ['line_id', 'recipient_id'];
    public $timestamps = false;
}
