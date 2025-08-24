<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Article;
use App\Models\Category;

class ExtraContentComposer
{
   public function compose(View $view)
   {  
      $congTrinhCategory = Category::where('slug', 'bai-dang-cong-trinh')->first();
      $camNhanCategory = Category::where('slug', 'bai-dang-cam-nhan-khach-hang')->first();

      $congTrinhArticles = collect();
      $camNhanArticles = collect();

      // EXTRA VIEW CONTENT
      if ($congTrinhCategory) {
         $congTrinhArticles = Article::with('category') // <-- thêm with('category') ở đây
               ->where('category_id', $congTrinhCategory->id)
               ->latest()
               ->take(1)
               ->get();
      }

      if ($camNhanCategory) {
         $camNhanArticles = Article::with('category') // <-- thêm with('category') ở đây
               ->where('category_id', $camNhanCategory->id)
               ->latest()
               ->take(1)
               ->get();
      }

      $view->with(compact(
         'congTrinhArticles',
         'camNhanArticles',
         'congTrinhCategory',
         'camNhanCategory'
      ));
   }
}
