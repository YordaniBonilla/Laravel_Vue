<?php
namespace App\Http\Controllers;
use App\Product;
use Cart;
use Illuminate\Http\Request;
class AppstoreController extends Controller
{
    public function index()
    {
   
        return view('home');
    }
    public function getCartContent() {
        $content = Cart::content();

        return response()->json($content);
    }
    public function getProducts() {
        $products = Product::all();

        return response()->json($products); 
    }
    # Our function for adding a certain product to the cart
    public function addToCart(Product $product)
    {   
        // return response()->json($product);
          if($product->price <= 0) return response()->json('Nothing is free');

          if($product->name) {
              Cart::add($product->id, $product->name, 1, $product->price);
               // return redirect('/home')->withSuccess("Anadido a $product->name a tu carrito");
              return response()->json('Succefully added');
          }
        
    }
    # Our function for removing a certain product from the cart
    public function removeProductFromCart($productId)
    {    
         $existe = null;
         foreach(Cart::content() as $row) {
            if($row->rowId === $productId) {
                $existe = true;
                break;
            }
            $existe = false;

        }
        
        if($existe) {
            $true = true;
            Cart::remove($productId);
            $existe = null;
            return response()->json($true);
        } else {
            // return view('./errors/422');
            return response()->json('error');
        }
        
        
    }
    # Our function for clearing all items from our cart
    public function destroyCart()
    {
        Cart::destroy();
        return response()->json('Cart Destroyed');
    }
}