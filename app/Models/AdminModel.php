<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table="admin_users";
    protected $primaryKey='id';
    protected $allowedFields=['username','email','password','full_name','is_active'];


    
}
