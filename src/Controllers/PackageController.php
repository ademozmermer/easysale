<?php


namespace AdemOzmermer\Controllers;


use AdemOzmermer\Entity\Category;
use AdemOzmermer\Entity\Option;
use AdemOzmermer\Entity\Product;
use Illuminate\Support\Arr;

class PackageController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::where('status', true)
            ->orderBy('sort_by', 'ASC')
            ->get();

        return view('easysale::index', [
            'categories' => $categories
        ]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($slug)
    {
        $slugArr = explode('-', $slug);

        $categoryId = Arr::last($slugArr);

        $category = Category::where('status', true)
            ->where('id', $categoryId)
            ->firstOrFail();

        $products = Product::where('status', true)
            ->where('category_id', $category->id)
            ->orderBy('sort_by', 'ASC')
            ->get();

        return view('easysale::category', [
            'category' => $category,
            'products' => $products
        ]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function product($slug)
    {
        $slugArr = explode('-', $slug);

        $productId = Arr::last($slugArr);

        $product = Product::with('variants')->findOrFail($productId);

        $optionsIds = $product->variants->pluck(['option_id'])->toArray();

        $optionsData = Option::whereIn('id', $optionsIds)
            ->orderBy('sort_by', 'ASC')
            ->get();


        $options = [];

        foreach ($optionsData as $option)
        {
            foreach ($product->variants as $variant)
            {
                $options[$option->id]['name'] = $option->name;
                if ($variant->option_id == $option->id)
                {
                    $options[$option->id]['variants'][] = [
                        'id' => $variant->id,
                        'name' => $variant->name,
                        'price' => $variant->pivot->price,
                        'price_type' => $variant->pivot->price_type,
                    ];
                }
            }
        }
        $options = array_values($options);

        return view('easysale::product', [
            'product' => $product,
            'options' => $options
        ]);
    }
}
