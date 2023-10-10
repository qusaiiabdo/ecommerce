<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductValueModel extends Model
{

    protected $table = 'product_value';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product_id', 'field_id', 'option_id', 'value'];



    public function setReturnType()
    {
        $this->tempReturnType = self::class;
    }

    public function field()
    {
        $fieldModel = new FieldModel();
        $fieldModel->setReturnType();
        return $fieldModel->where(['id' => $this->field_id])->first();
    }

    public function option()
    {
        $optionModel = new OptionsModel();
        $optionModel->setReturnType();
        return $optionModel->where(['id' => $this->option_id])->first();
    }


    public function assignedFieldsOptions($id)
    {
    }
}
