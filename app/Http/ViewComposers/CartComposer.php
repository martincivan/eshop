<?php
/**
 * Created by IntelliJ IDEA.
 * User: martin
 * Date: 15.11.2018
 * Time: 19:16
 */

namespace app\Http\ViewComposers;


use Illuminate\View\View;

class CartComposer {

    public function compose(View $view)
    {
        $view->with('numberInCart', session()->exists('cart') ? array_sum(session()->get('cart')) : 0);
    }
}
