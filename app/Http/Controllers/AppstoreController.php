<?php
namespace App\Http\Controllers;
use App\Product;
use Cart;
class AppstoreController extends Controller
{
    public function index()
    {
        # We pass all the products from the database into
        # the $products variable, which is an array
        $products = Product::all();
        # We use the home view for the tutorial, but you could
        # use other views too. Home will be our webstore view
        return view('home')->with('products', $products);
    }
    # Our function for adding a certain product to the cart
    public function addToCart(Product $product)
    {   
        if($product->price <= 0) return redirect('/home');

        if($product->name) {
            Cart::add($product->id, $product->name, 1, $product->price);
            return redirect('/home')->withSuccess("Anadido a $product->name a tu carrito");
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
            
            Cart::remove($productId);
            $existe = null;
            return redirect('/home');
        } else {
            return view('./errors/422');
        }
        
        
    }
    # Our function for clearing all items from our cart
    public function destroyCart()
    {
        Cart::destroy();
        return redirect('/home');
    }
}