<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo_usuario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipo_usuario';
    protected $fillable = ['id','descricao'];
    protected $dates = [''];


}
