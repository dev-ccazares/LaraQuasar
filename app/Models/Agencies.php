<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agencies extends Model
{
    use HasFactory;

    protected $connection = 'sugar';
    protected $table = 'cb_agencias';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id', 'name', 'date_entered', 'date_modified', 'modified_user_id', 'created_by',
        'description', 'deleted', 's3s_id',
        'team_id', 'team_set_id', 'assigned_user_id'
    ];

    public static function getAll()
    {
        return self::where('deleted', 0)->pluck('name', 'id');
    }

    public static function getAllCodeName()
    {
        return self::select('id as code', 'name', 'assigned_user_id')->where('deleted', 0)->orderBy('name')->get();
    }

    public static function getAllCodeNameByLine($line)
    {
        return self::select('cb_agencias.id as code', 'cb_agencias.name')
            ->join('cb_agencias_cb_lineanegocio_c', 'cb_agencias.id', '=', 'cb_agencias_cb_lineanegociocb_agencias_ida')
            ->join('cb_lineanegocio', 'cb_lineanegocio.id', '=', 'cb_agencias_cb_lineanegociocb_lineanegocio_idb')
            ->where('cb_lineanegocio.name', $line)
            ->where('cb_agencias.deleted', 0)
            ->where('cb_agencias_cb_lineanegocio_c.deleted', 0)
            ->orderBy('cb_agencias.name')->get();
    }

}
