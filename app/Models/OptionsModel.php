<?php 
namespace App\Models;
use CodeIgniter\Model;
class OptionsModel extends Model
{

    protected $table='options';
    protected $primaryKey='id';
    protected $allowedFields=['label','field_id'];

    public function setReturnType()
    {
        $this->tempReturnType = self::class;

    }

}