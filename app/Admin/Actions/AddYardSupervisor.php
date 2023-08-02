<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\Log;
use App\Models\Yard;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class AddYardSupervisor extends RowAction
{
    public $name = 'Add Supervisor';
    public function handle(Model $model, Request $request)
    {
        try {
            $id = $request->user;
            if(isset($id) && !empty($id))
            {
            $yard=Yard::find($model->id);
            $yard->supervisorid=$id ;
            $yard->save();
            return $this->response()->success("Saved Successfully")->refresh();
            }
        } catch (\Throwable $ex) {
            //return $this->response()->error('Oops! Sending mail has encountered some internal problem');
            Log::info($ex->getMessage());
        }
    }
    public function form()
    {
        // Fetch supervisors with the role "YardCreator" and map them to id => username array
        // $supervisors = AdminUser::whereHas('roles', function ($query) {
        //     $query->where('name', 'administrator');
        // })->pluck('username', 'id')->toArray();
        $supervisors = AdminUser::whereHas('roles', function ($query) {
            $query->where('name', 'YardCreator');
        })->whereNotIn('id', Yard::pluck('supervisorid')->toArray())
          ->pluck('username', 'id')
          ->toArray();
        // Add the select field to the form
        $this->select('user', 'Supervisor Username')->options($supervisors);
    }
}


