<?= $this->extend('client/layouts/main') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="/css/checkout.css">
<style>
    body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-color: #fff;
    background-repeat: no-repeat;
}
</style>



  <body class="bg-light">
  <div class="container px-3 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-5">
            <h4 class="heading">Items</h4>
        </div>
        <div class="col-7">
            <div class="row text-right">
                <div class="col-4">
                    <h6 class="mt-2">Description</h6>
                </div>
                <div class="col-3">
                    <h6 class="mt-2">Quantity</h6>
                </div>
                <div class="col">
                    <h6 class="mt-2">Price</h6>
                </div>

                <div class="col-2">
                    <h6 class="mt-2">subTotal</h6>
                </div>
                
            </div>
        </div>
        
    </div>
    
    <?php foreach($cartItems as $item){?>

    <div class="row d-flex justify-content-center border-top">
        <div class="col-5">
            <div class="row d-flex">
                <div class="book">
                    <img src="<?=base_url('writable/uploads/'.$item['cartItem']['image'])?>" class="book-img">
               
                    <br>
                    <br>
                    <div class="my-auto flex-column d-flex pad-left">
                    <h6 class="mob-text"><?=$item['cartItem']['title']?></h6>
                    <!-- <p class="mob-text">Daniel Kahneman</p> -->
                </div>
                </div>
                
            </div>
            <br>
            
        </div>
        <d  iv class="my-auto col-7">
            <div class="row text-right">
                <div class="col-4">
                    <p class="mob-text"><?=$item['cartItem']['description']?></p>
                </div>
                <div class="col-3">
                    <div class="row d-flex justify-content-end px-4">
                        <p class="mb-0" id="cnt1"><?=$item['quantity']?></p>
                        <div class="d-flex flex-column plus-minus">
                        <a href="/clientdashboard/addtoCart/<?=$item['cartItem']['id']?>" id="plus-link">
                          <span class="vsm-text plus">+</span>
                             </a>
                            <a href="/clientdashboard/removeFromCart/<?=$item['cartItem']['id']?>" id="minus-link">
                            <span class="vsm-text minus col-7">-</span>

                             </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <h6 class="mob-text">$<?=$item['cartItem']['price']?></h6>
                </div>

                <div class="col-2">
                    <h6 class="mob-text">$<?=$item['subTotal']?></h6>
                </div>
            </div>
        </d>
   

    </div>
    <?php } ?>

  
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-lg-3 radio-group">
                        <div class="row d-flex px-3 radio">
                            <img class="pay" src="https://i.imgur.com/WIAP9Ku.jpg">
                            <p class="my-auto">Credit Card</p>
                        </div>
                        <div class="row d-flex px-3 radio gray">
                            <img class="pay" src="https://i.imgur.com/OdxcctP.jpg">
                            <p class="my-auto">Debit Card</p>
                        </div>
                        <div class="row d-flex px-3 radio gray mb-3">
                            <img class="pay" src="https://i.imgur.com/cMk1MtK.jpg">
                            <p class="my-auto">PayPal</p>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="row px-2">
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Name on Card</label>
                                <input type="text" id="cname" name="cname" placeholder="Qusai abdo">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Card Number</label>
                                <input type="text" id="cnum" name="cnum" placeholder="1111 2222 3333 4444">
                            </div>
                        </div>
                        <div class="row px-2">
                            <div class="form-group col-md-6">
                                <label class="form-control-label">Expiration Date</label>
                                <input type="text" id="exp" name="exp" placeholder="MM/YYYY">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-control-label">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="***">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-2">
                        <div class="row d-flex justify-content-between px-4">
                            <p class="mb-1 text-left">Subtotal</p>
                            <h6 class="mb-1 text-right">$<?=$totPrice?></h6>
                        </div>
                        <div class="row d-flex justify-content-between px-4">
                            <p class="mb-1 text-left">Tax</p>
                            <?php $tax=.025;
                            $taxamount=$totPrice*$tax?>
                            <h6 id ="shipping"class="mb-1 text-right">$<?=$taxamount?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;%<?=$tax*100?></h6>
                        </div>
                        <div class="row d-flex justify-content-between px-4">
                            <p class="mb-1 text-left">Shipping</p>
                            <?php $shipping=2.99;?>
                            <h6 id ="shipping"class="mb-1 text-right">$<?=$shipping?></h6>
                        </div>
                     
                        <div class="row d-flex justify-content-between px-4" id="tax">
                            <p class="mb-1 text-left">Total (tax included)</p>
                            <h6 class="mb-1 text-right">$<?=$totPrice+$taxamount+$shipping?></h6>
                        </div>
                        <button class="btn-block btn-blue">
                            <span>
                                <span id="checkout" style="margin-right: 5px;">Checkout </span>
                                <span id="check-amt"> $<?=$totPrice+$taxamount+$shipping?></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  </body>

  <script>

  </script>
<?=$this->endSection()?>