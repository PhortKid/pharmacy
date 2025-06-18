<?php 
namespace App\Observers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class AuditLogObserver
{
    public function created($model)
    {
        /*
        AuditLog::create([
            'user_id' => Auth::id(),
            'event' => 'created',
            'pharmacy_id' => Auth::user()->pharmacy_id,
            'table_name' => $model->getTable(),
            'new_data' => json_encode($model->getAttributes()),
            'ip_address' => request()->ip(),
        ]);*/
    }

    public function updated($model)
    {
        /*
        AuditLog::create([
            'user_id' => Auth::id(),
            'event' => 'updated',
            'table_name' => $model->getTable(),
            'old_data' => json_encode($model->getOriginal()),
            'new_data' => json_encode($model->getChanges()),
            'ip_address' => request()->ip(),
        ]);
        */
    }

    public function deleted($model)
    {
        /*
        AuditLog::create([
            'user_id' => Auth::id(),
            'event' => 'deleted',
            'table_name' => $model->getTable(),
            'old_data' => json_encode($model->getAttributes()),
            'ip_address' => request()->ip(),
        ]);
        */
    }
}
