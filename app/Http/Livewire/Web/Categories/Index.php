<?php

namespace App\Http\Livewire\Web\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination ;
    protected $paginationTheme = "home-paginate";


    public function render()
    {
        return view('livewire.web.categories.index' ,[
            'data' => Category::with('photo')->paginate(12)
        ])->layout('layouts.home' , [
            'title' => 'دسته بندی ها' ,
            'script' => 'category.js' ,
            'style' => 'category.css' ,
        ]);
    }
}
