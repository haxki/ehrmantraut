<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Spy extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function process(Request $request) {
        Spy::create([
            'path' => $request->path(),
            'ip' => $request->ip(),
            'host' => $request->host(),
            'browser' => $request->userAgent(),
        ]);
    }
}
