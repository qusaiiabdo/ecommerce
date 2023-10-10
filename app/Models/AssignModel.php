<?php 
namespace App\Models;
use CodeIgniter\Model;
class AssignModel extends Model
{

    protected $table='assign';
    protected $primaryKey='id';
    protected $allowedFields=['subcat_id', 'field_id'];

    public function setReturnType()
    {
        $this->tempReturnType = self::class;
    }

    public function field() {
        $fieldModel = new FieldModel();
        $fieldModel->setReturnType();
        return $fieldModel->where(['id' => $this->field_id])->first();
    }
}