<?php

namespace App\Livewire\Admin\Users;

use App\Models\Admins;
use App\Models\Tables;
use Livewire\Component;
use App\Models\Permission;
use App\Models\AdminPermission as AdminPermissionModel;
use Illuminate\Support\Facades\URL;

class AdminPermission extends Component
{

    #[URL()]

    public $admin;
    public function render()
    {
        $admins = Admins::find($this->admin);
        $tables = Tables::all();
        $permissions =  Permission::all();
        
        return view('livewire.admin.users.admin-permission' , compact('admins' , 'tables' , 'permissions' ) );
    }



    public function store($admin_id , $permission_id){
        $info = AdminPermissionModel::where('admin_id', $admin_id)->where('permission_id', $permission_id)->first(); 
        if ($info) {
            $info->delete();
        } else {
            AdminPermissionModel::create([
                'permission_id' => $permission_id,
                'admin_id' => $admin_id, 
            ]);
        } 
    }
}
