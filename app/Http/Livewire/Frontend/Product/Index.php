<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Wishlist;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $category, $categories, $featuredproduct, $brand = [], $short, $search, $price;

    protected $queryString = [
        'brand' => ['except' => '', 'as' => 'brand'],
        'short',
        'search',
        'price'
    ];

    public function mount($category, $categories, $featuredproduct)
    {
        $this->category = $category;
        $this->categories = $categories;
        $this->featuredproduct = $featuredproduct;
    }

    public function addproductwishlist($product_id)
    {
        $this->product_id = $product_id;
        
        if(Auth::check())
        {
            if(Product::where('id', $product_id)->where('status', '0')->exists())
            {
                if(Wishlist::where('user_id', Auth::user()->id)->where('product_id', $this->product_id)->exists())
                {
                    session()->flash('status', 'You already added this product in the wishlist!');
                    $this->dispatchBrowserEvent('message', [
                        'text'      => 'You already added this product in the wishlist!',
                        'type'      => 'warning',
                        'status'    => 409
                    ]);
                    return false;
                }
                else {
                    Wishlist::create([
                        'user_id'       => Auth::user()->id,
                        'product_id'    => $this->product_id
                    ]);    
                    
                    $this->emit('wishlistupdate');
                    session()->flash('status', 'Your wishlist added successfully!');
                    $this->dispatchBrowserEvent('message', [
                        'text'      => 'Your wishlist added successfully!',
                        'type'      => 'success',
                        'status'    => 200
                    ]);
                    return false;       
                }
            }
            else
            {
                session()->flash('status', 'Proudct not found!');
                $this->dispatchBrowserEvent('message', [
                    'text'      => 'Proudct not found!',
                    'type'      => 'error',
                    'status'    => 404
                ]);
                return false; 
            }
        }
        else
        {
            session()->flash('status', 'Please login to add this product in your wishlist!');
            $this->dispatchBrowserEvent('message', [
                'text'      => 'Please login to continue!',
                'type'      => 'notify',
                'status'    => 401
            ]);
            return false;
        }
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
                            ->when($this->price, function($q){
                                $q->when($this->price == 'high-to-low', function($q2){
                                    $q2->orderBy('selling_price', 'DESC');
                                })
                                ->when($this->price == 'low-to-high', function($q2){
                                    $q2->orderBy('selling_price', 'ASC');
                                });
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
