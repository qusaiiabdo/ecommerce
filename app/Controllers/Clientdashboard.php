<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductsModel;
use App\Models\ProductValueModel;

use function PHPUnit\Framework\isNull;

class Clientdashboard extends BaseController
{
    protected $productsModel;
    protected $productValueModel;
    

    public function __construct()
    {
        $this->productsModel = new ProductsModel();
        $this->productValueModel=new ProductValueModel();
    }

    public function index()
    {
        // dd(session()->get());

        $data['products'] = $this->productsModel->orderBy('id', 'DESC')->findAll();

        return view('client/shop', $data);
    }


    public function about()
    {
        return view('client/about');
    }

    public function options($id)
    {

      


        $data['product'] = $this->productsModel->where('id', $id)->first();
        if (!$data['product']) {

            return redirect()->route('not-found');
        }

        
        $data['products'] = $this->productsModel->getRelateditems($id);

        $this->productValueModel->setReturnType();
        $data['product']['details']=[];
        $details=$this->productValueModel->where('product_id',$id)->findAll();

        foreach ($details as $detail){
            $data['product']['details'][$detail->field()->label]=$detail->option()->label;
        }

        
        return view('client/shopitem', $data);
    }


    public function addtoCart($itemid)
    {
        $session = session();
        $quantity = $this->request->getPost('inputQuantity');
        if(!isset($quantity)){
            $quantity=1;
        }
        $item = $this->productsModel->where('id', $itemid)->first();

        $price = $item['price'];


        //dd($price);        

        if (!$session->has('cartitems')) {
            $session->set('cartitems', []);
            $session->set('totQuantity');
            
        }
        
        $totQuantity = $session->get('totQuantity', 0);
        $totPrice = $session->get('totPrice', 0);
        $subTotal = $session->get('subTotal', 0);




        $cartitems = $session->get('cartitems',[]);

        if (isset($cartitems[$itemid])) {
            // If the item is already in the cart, increment the quantity
            $cartitems[$itemid]['quantity'] += $quantity;
            $cartitems[$itemid]['subTotal']+=$price*$quantity;
            $totPrice+=$price*$quantity;

        } else {
            // Otherwise, add the item to the cart
            $cartitems[$itemid] =[
                'quantity'=>$quantity,
                'price'=>$price,
                'subTotal'=>$subTotal
            ];
            $cartitems[$itemid]['subTotal']+=$price;

            $totPrice+=$price;
           
        }

        $session->set('cartitems', $cartitems);

        // $totQuantity+=$quantity;
        $totQuantity = array_sum(array_column($cartitems, 'quantity'));
       // $totPrice = array_sum(array_column($cartitems, 'price'));

        $session->set('totQuantity', $totQuantity);
        $session->set('totPrice', $totPrice);


        //dd(session()->get('cartitems'));

        return redirect()->back();
    }

    public function removeFromCart($itemid)
    {
        $session = session();
        $cartitems = $session->get('cartitems', []);

        $item = $session->get('cartitems')[$itemid];
        $price=$item['price'];
        $totPrice=$session->get('totPrice');
        $quantity = $item['quantity'];
       

        if ($quantity > 1) {
            if (isset($cartitems[$itemid])) {
                // If the item is already in the cart, increment the quantity
                $cartitems[$itemid]['quantity'] -= 1;
                $cartitems[$itemid]['subTotal']-=$price;
                $totPrice-=$price;
    

            }
        } else {
            $cartitems[$itemid]['quantity'] -= 1;
            $cartitems[$itemid]['subTotal']-=$price;
            $totPrice-=$price;
            unset($cartitems[$itemid]);
            //return redirect()->to('clientdashboard/cartitems');
            
        }

        $session->set('cartitems', $cartitems);
        $totQuantity = array_sum(array_column($cartitems, 'quantity'));
        $session->set('totQuantity', $totQuantity);
        $session->set('totPrice',$totPrice);

        return redirect()->back();
    }

    public function cartItems()
    {


        $items = session()->get('cartitems',[]);

        if(!count($items)==0){


        foreach ($items as $item => $itemConfig) {
            //dd($itemConfig);
            $data['cartItems'][] = [

                'cartItem' => $this->productsModel->where('id', $item)->first(),
                'quantity' => $itemConfig['quantity'],
            ];
  
        }

        return view('client/clientcart', $data);

    }else{
        return view('client/clientcart');
    }
    }


    public function checkout()
    {
        $items = session()->get('cartitems');
        $totPrice=session()->get('totPrice');

        foreach ($items as $item => $itemConfig) {

            $data['cartItems'][] = [

                'cartItem' => $this->productsModel->where('id', $item)->first(),
                'quantity' => $itemConfig['quantity'],
                'subTotal'=>$itemConfig['subTotal']
            ];
            $data['totPrice']=$totPrice;
        }

        return view('client/checkout', $data);
    }
}
