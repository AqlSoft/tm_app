<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    //
    public $timestamps = true;
    protected $table = 'operations';
    protected $fillable = [
        'project_id',
        's_number',
        'name',
        'description',
        'order',
        'created_by',
        'updated_by',
        'supervisor_id',
        'status',
    ];
    
    public $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'starts_at',
        'deadline',
        'completed_at'
    ];
    
    public function project () {
        return $this->belongsTo(Project::class);
    }

    /* tasks */
    public function tasks () {
        return $this->hasMany(Task::class);
    }

    public static function getLastOperationOrder($project) {
        $lastOperation = Operation::where('project_id', $project->id)->orderBy('id', 'desc')->first();
        if ($lastOperation) {
            $order = intval(substr($lastOperation->s_number, -6)) + 1;
        } else {
            $order = 1;
        }
        return $order;
    }

    public static function generateSerialNumber($project) {
        $psn = substr($project->s_number, -6) ;
        $csn = substr($project->client->s_number, -6) ;
        $order = self::getLastOperationOrder($project);
        return 'C'.trim($csn, '0').'P'.trim($psn, '0').'PRS'.str_pad($order, 6, '0', STR_PAD_LEFT);
    }

    /* Creator */
    public function creator () {
        return $this->belongsTo(User::class, 'created_by');
    }

    /* Editor */
    public function editor () {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /* Supervisor */
    public function supervisor () {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
