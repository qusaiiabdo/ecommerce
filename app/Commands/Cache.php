<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Services;
use App\Classes\redishandler;

class Cache extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'CodeIgniter';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'cache:run';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = '';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'command:name [arguments] [options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        /** @var redishandler $cache */
        $cache = Services::cache();
        $redis = $cache->getRedis();

        // ********** Cache Data *************
        $model = model('App\Models\CategoryModel');

        // ********** set categories  Redis ***********

        // $categories = $model->where(['parent_id' => null])->findAll();
        // $categories = json_encode($categories, JSON_UNESCAPED_UNICODE);
        // $redis->set('categories', $categories);
        // var_dump($redis->get('categories'));


        // ********** set subcategories  Redis ***********

        // $subcategories=$model->where('parent_id IS NOT NULL')->findAll();
        // $subcategories=json_encode($subcategories,JSON_UNESCAPED_UNICODE);
        // $redis->set('subcategories',$subcategories);
        
       // var_dump($red)

        // ********** Get from Redis ***********
        // $categories = $redis->get('categories');
        // $categories = json_decode($categories, true);


        // *********** HASH SET categories ******************
        // $categories=$model->where('parent_id',null)->findAll();
        // foreach($categories as $category){
        //     $redis->hSet('hashcategories',$category['id'],json_encode($category,JSON_UNESCAPED_UNICODE));
        // }


        
        // *********** HASH SET subcategories ******************
        // $subCategories = $model->where('parent_id IS NOT NULL')->findAll();
        // foreach ($subCategories as $subCategory) {
        //     $redis->hSet('hashsubcategories', $subCategory['id'], json_encode($subCategory, JSON_UNESCAPED_UNICODE));
        // }


        // *********** HASH SET relatedsub ******************
        $parentIds=$redis->hkeys('hashcategories');
        
        foreach($parentIds as $parentId){
            $ids = [];
            $subcategories=$model->select('id')->where('parent_id',$parentId)->findAll();
            
            foreach($subcategories as $subcategory){
                $ids[]=$subcategory['id'];

            }
            $redis->hSet('relatedsub',$parentId,json_encode($ids,JSON_UNESCAPED_UNICODE));


        }
       // dd($parentIds);

                // *********** HASH GET ******************

        // $result = [];
        // $subCategoriesIds = $redis->hKeys('subcategories');

        // foreach ($subCategoriesIds ?? [] as $subCategoryId) {

        //     $subCategoryData = $redis->hGet('subcategories', $subCategoryId);
        //     $result[] = json_decode($subCategoryData, true);
        // }

       
        
        


        //var_dump($result);


        // $id = 3;
        // $subCategory = $redis->hget('subcategories', $id);
    }
}
