<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\productsModel;
use App\Models\CategoryModel;
use App\Models\ProductValueModel;
use Config\Services;
use SplQueue;

use function PHPUnit\Framework\isNull;

class ProductController extends BaseController
{

    protected $productsModel;
    protected $categoriesModel;
    protected $productValueModel;

    public function __construct()
    {
        $this->productsModel = new productsModel();
        $this->categoriesModel = new CategoryModel();
        $this->productValueModel = new ProductValueModel();
    }

    public function index()
    {

        $data['categories'] = $this->categoriesModel->findCategories();
        $data['subcategories'] = $this->categoriesModel->findSubcategories();
        $data['products'] = $this->productsModel->getProductsWithCategories();
    



        $this->productValueModel->setReturnType();

        foreach ($data['products'] as &$product) {
            $model = clone $this->productValueModel;
            $details = $model->where('product_id', $product['id'])->findAll();

            $product['details'] = [];

            foreach ($details as $detail) {

                if (is_object($detail)) {
                
                    $product['details'][$detail->field()->label] = $detail->option()->label;
                }
            }
        }


        return view('admin/dashboard', $data);
    }


    public function create()
    {
        
        
        /*************** testing redis   ******************/

          /** @var redishandler $cache */
          $cache = Services::cache();
          $redis = $cache->getRedis();
          
          if(count($redis->hkeys('hashcategories'))!=0){
            $data['categories']=json_decode($redis->get('categories'),true);

           
          }
          else{
            $data['categories'] = $this->categoriesModel->findCategories();

        
            }   

        /***************  redis   ******************/

        //$data['categories'] = $this->categoriesModel->findCategories();

        $this->categoriesModel->setReturnType();
        $data['subcategories'] = $this->categoriesModel->findSubcategories();

        $data['products'] = $this->productsModel->getProductsWithCategories();

        return view('admin/addproduct', $data);
    }

    public function store()
    {
        if ($this->request->is('post')) {

            $productsModel = new productsModel();

            $image = $this->request->getFile('image');

            if ($image->isValid() && !$image->hasMoved()) {
                $newName = $image->getRandomName();

                $image->move('writable/uploads/', $newName);



                $data = [
                    'title' => $this->request->getVar('title'),
                    'description' => $this->request->getVar('description'),
                    'category_id' => $this->request->getVar('category_id'),
                    'subcategory_id' => $this->request->getVar('subcategory_id'),
                    'price' => $this->request->getVar('price'),
                    'image' => $newName,
                ];

                $productsModel->insert($data);

                $product_id = $productsModel->insertID();
                $field = $this->request->getVar('field');

                foreach ($field as $key => $value) {

                    $data = [
                        'product_id' => $product_id,
                        'field_id' => $key,
                        'option_id' => $value
                    ];

                    $this->productValueModel->insert($data);
                }

                return redirect()->to('productcontroller');
            } else {
                return redirect()->back()->with('error', 'File upload failed.');
            }
        }
    }


    public function test()
    {
        return 'Hello world!';
    }

    public function edit($id)
    {
        $data['categories'] = $this->categoriesModel->findCategories();
        $data['product'] = $this->productsModel->getProductWithCategory($id);
        $data['product']['subcategories']=$this->categoriesModel->getSubcategoriesByCategory($data['product']['category_id']);
      
        $this->categoriesModel->setReturnType();
        $subcategory=$this->categoriesModel->where('id',$data['product']['subcategory_id'])->first();
        $data['subCategoryFields']=$subcategory->assignedFields();

        $this->productValueModel->setReturnType();
        $details=$this->productValueModel->where('product_id',$data['product']['id'])->findAll();

        foreach($details as $detail){
            $data['product']['details'][$detail->field()->label]=$detail->option()->label;
        }




        return view('admin/updateproduct', $data);

        return $this->response->setJSON($data);
    }

    public function update($id)
    {

        $image = $this->request->getFile('image');



        if ($image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();


            $image->move('writable/uploads/', $newName);

            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'category_id' => $this->request->getVar('category_id'),
                'subcategory_id' => $this->request->getVar('subcategory_id'),
                'price' => $this->request->getVar('price'),
                'image' => $newName,

            ];
        } else {
            $data = [
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'category_id' => $this->request->getVar('category_id'),
                'subcategory_id' => $this->request->getVar('subcategory_id'),
                'price' => $this->request->getVar('price'),

            ];
        }
        //dd($data);

        $this->productsModel->update($id, $data);
        $field = $this->request->getVar('field');

        foreach ($field as $key => $value) {

            $data = [
                'product_id' => $id,
                'field_id' => $key,
                'option_id' => $value
            ];
            $productvalid=$this->productValueModel->getIdValue($this->productValueModel->where('product_id',$id)->first());
            $this->productValueModel->delete($productvalid);


            // $this->productValueModel->delete()

            $this->productValueModel->insert($data);
        }

        return redirect()->to('productcontroller');
    }


    public function delete($id)
    {
        $data['product'] = $this->productsModel->where('id', $id)->first();
        if ($this->request->is('post')) {
            $product = $this->productsModel->where('id', $id)->first();
            $imageFileName = $product['image'];

            
            $this->productsModel->where('id', $id)->delete();


            // Delete the image file from the folder
            if (!empty($imageFileName)) {

                $imagePath = 'writable/uploads/' . $imageFileName;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }



            return redirect()->to('productcontroller');
        }
        return view('admin/deleteproduct', $data);
    }



    public function fetchSubcategories()
    {
        
        $category_id = $this->request->getPost('category_id'); // Get the selected category ID from the POST request
        $subcategories = $this->categoriesModel->getSubcategoriesByCategory($category_id);


        return $this->response->setJSON($subcategories);
    }

    public function fetchFields()
    {
        $subcategory_id = $this->request->getPost('subcategory_id');
        $this->categoriesModel->setReturnType();
        $subcategory = $this->categoriesModel->where('id', $subcategory_id)->first();

        $data['subCategoryFields'] = $subcategory->assignedFields();

        return view('admin/fields', $data);
    }
}
