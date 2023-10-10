<?php 
namespace App\Models;
use CodeIgniter\Model;
class FieldModel extends Model
{

    protected $table='fields';
    protected $primaryKey='id';
    protected $allowedFields=['label'];

    public function setReturnType()
    {
        $this->tempReturnType = self::class;

    }

    public function options() {
        
        $optionModel = new OptionsModel();
        return $optionModel->where(['field_id' => $this->id])->findAll();
    }

}