<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Services;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['label', 'parent_id'];


    public function getSubcategoriesByCategory($category_id)
    {

        /** @var redishandler $cache */
        $cache = Services::cache();
        $redis = $cache->getRedis();

        if ($redis->exists('relatedsub')) {


            $related = $redis->hGet('relatedsub', $category_id);
            $rels = json_decode($related, true);
            $result = [];
           
            foreach ($rels as $rel) {
                $result[] = json_decode($redis->hGet('hashsubcategories', $rel),true);
            }
         
            return $result;
        } else {

            return $this->where('parent_id', $category_id)->findAll();
        }
    }

    public function findCategories()
    {
        return $this->where('parent_id', null)->findAll();
    }

    public function findSubcategories()
    {
        /** @var redishandler $cache */
        $cache = Services::cache();
        $redis = $cache->getRedis();


        if (count($redis->hkeys('hashsubcategories')) != 0) {

            return json_decode($redis->get('subcategories'), true);

        } else {

            return $this->where('parent_id IS NOT NULL')->findAll();
        }
    }

    public function setReturnType()
    {
        $this->tempReturnType = self::class;
    }

    public function assignedFields() {

        $assignModel = new AssignModel();
        $assignModel->setReturnType();
        $assignedFields = $assignModel->where(['subcat_id' => $this->id])->findAll();
        return $assignedFields;

        
    }
}
