<?php

namespace App\Controllers;
use Config\Services;
use CodeIgniter\Cache\Cache;

use App\Models\ProductModel;
use App\classes\redishandler;
use App\Classes\redishandler as ClassesRedishandler;

class Home extends BaseController
{
   
    public function index(){
        /** @var RedisHandler $cache */
        $cache = \Config\Services::cache();

                   // Load the model
           $productModel = new ProductModel();

        //   phpinfo();
           // Define a unique cache key for the product catalog
           $cacheKey = 'product_catalog';
           $redisInstance = $cache->getRedis();
           $cache->save($cacheKey,'product_catalogd');
       
           $productCatalog = $cache->get($cacheKey);
          // $productCatalog = null;
               //dd($cache->keys());
           //dd($productCatalog);
           
        dd($cache->getKeys('*'));
           if ($productCatalog === null) {
               // Data is not in the Redis cache; fetch it from the database
               $products = $productModel->findAll();
   
               // Transform the products into an array (you may need to adjust this based on your data structure)
               $productCatalog = [];
               foreach ($products as $product) {
                   $productCatalog[$product['id']] = [

                       'model' => $product['model'],
                       'category'=>$product['category'],
                       'price' => $product['price'],
                       // Add more product details as needed
                   ];
               }
   
               // Store the product catalog in the Redis cache for a reasonable expiration time (e.g., 1 hour)
               cache()->save($cacheKey, $productCatalog, 3600);
           }

           return view('test', ['productCatalog' => $productCatalog]);

       
    }
}
