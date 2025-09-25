<?php

namespace App\Http\Controllers\Site\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\General\CartRepository;

class CartController extends Controller
{
   public function __construct(protected CartRepository $cartRepo){ }


    public function index()
    {
        $cart = $this->cartRepo->getCart();
        $total = $this->cartRepo->getTotal($cart);

        return view('site.user.cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request, $productId)
    {
        $this->cartRepo->addToCart($productId);

        return redirect()->back()->with('success', 'تمت إضافة المنتج إلى السلة');
    }

    public function removeFromCart($productId)
    {
        $this->cartRepo->removeFromCart($productId);

        return redirect()->back()->with('success', 'تم حذف المنتج من السلة');
    }

    public function checkout(Request $request)
    {
        $order = $this->cartRepo->checkout($request);

        if (!$order) {
            return redirect()->back()->with('error', 'السلة فارغة');
        }

        return redirect()->route('site.cart.index')
            ->with('success', '✅ تم تسجيل الطلب بنجاح');
    }
}
