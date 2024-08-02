<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ApisKey extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    static function validate_web_api_request($key)
    {

        $our_key = DB::table('apis_keys')->whereKey('opus_web_api_key')->first()->value;
        if ($key == $our_key) {
            return true;
        }
        return false;
    }

}
