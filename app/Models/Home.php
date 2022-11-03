<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table= 'slide';
    protected $fillable=['id','link','image'];
    // public function mf(){
    //     return $this->belongsTo(Mf::class,'mf_id','id');
    // }
}
