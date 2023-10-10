<?php

namespace App\Models;

use CodeIgniter\BaseModel;
use CodeIgniter\Model;
use App\Models\CategoryModel;

class ProductsModel extends Model
{

    protected $table = 'productss';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'category_id', 'subcategory_id', 'price', 'image'];

    public function getProductsWithCategories()
    {


        $this->select('productss.* ,categories.label AS category_label, subcategories.label AS subcategory_label');
        $this->join('categories', 'categories.id = productss.category_id');
        $this->join('categories AS subcategories', 'subcategories.id = productss.subcategory_id AND subcategories.parent_id IS NOT NULL', 'left');
       // $this->join('product_value','product_value.product_id=productss.id','left');
        
        return $this->findAll();
    }

    public function getProductWithCategory($id)
    {


        $this->select('productss.*, categories.label AS category_label, subcategories.label AS subcategory_label');
        $this->join('categories', 'categories.id = productss.category_id');
        $this->join('categories AS subcategories', 'subcategories.id = productss.subcategory_id AND subcategories.parent_id IS NOT NULL', 'left');
        $this->where('productss.id',$id);
        return $this->first();
    }

    public function getRelateditems($id)
    {
        $item = $this->where('id', $id)->first();

        return $this
            ->where('id !=', $id)
            ->where('subcategory_id', $item['subcategory_id'])
            ->findAll();
    }

    public function setReturnType()
    {
        $this->tempReturnType = self::class;
    }


    public function assignedFields() {

        $productvalmodel=new ProductValueModel();
        $productvalmodel->setReturnType();
        $assignedFields = $productvalmodel->where(['product_id' => $this->id])->findAll();
        return $assignedFields;

        
    }
}
