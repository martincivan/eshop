<?php
/**
 * Created by IntelliJ IDEA.
 * User: martin
 * Date: 15.11.2018
 * Time: 19:16
 */

namespace app\Http\ViewComposers;


use Illuminate\View\View;
use App\Category;

class CategoriesComposer {

    public function compose(View $view)
    {
        $view->with('categories', Category::all());
    }
}
