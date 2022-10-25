<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class __NomeModel__ extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = '__Tabela__';
    protected $fillable = [__Campos__];
    protected $dates = [__Datas__];

}
