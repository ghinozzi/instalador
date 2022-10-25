<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teste extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = array('NmGrupo','FlAdmin');
    protected $casts = ['FlAdmin' => "boolean"];

}
