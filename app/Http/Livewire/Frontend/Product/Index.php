<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category, $categories, $featuredproduct, $brand = [], $short, $search;

    protected $queryString = [
        'brand' => ['except' => '', 'as' => 'brand'],
        'short',
        'search'
    ];

    public function mount($category, $categories, $featuredproduct)
    {
        $this->category = $category;
        $this->categories = $categories;
        $this->featuredproduct = $featuredproduct;
    }

    public function render()
    {
        $products = Product::where('category_id', $this->category->id)
                            ->when($this->search, function($q){
                                $q->where('name', 'like', '%'.$this->search.'%');
                            })
                            ->when($this->short, function($q){
                                $q->orderBy('created_at', $this->short);
                            })
                            ->when($this->brand, function($q){
                                $q->whereIn('brand', $this->brand);
                            })
                            ->where('status', '0')
                            ->paginate(9);

        return view('livewire.frontend.product.index', [
            'products' => $products,
            'categories' => $this->categories,
            'featured_product' => $this->featuredproduct,
        ]);
    }
}
