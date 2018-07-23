<?php

namespace App\Http\Controllers;

use App\Models\Line;
use Illuminate\Http\Request;

class LineController extends Controller {
    public function index($id) {
        $line = Line::with('modality', 'financingType', 'areas', 'recipients')->where('id', '=', $id)->first();
        
        return view('line', compact('line'));
    }
}
