<?php

namespace App\Http\Livewire\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;
    public Brand $brand;

    protected $rules = [
        'brand.title' => 'required|string|min:4',
        'brand.label' => 'required|string|min:3',
    ];
    public function mount()
    {
        $this->brand = new Brand();
    }

    public function create()
    {
        $this->authorize('create' , [Brand::class , auth()->user()]);
        $this->validate();
        $this->validate([
            "brand.name" => [ Rule::unique('brands' , 'name')] ,
            "brand.title" => [ Rule::unique('brands' , 'title')] ,
        ]);
        $this->brand->save();
        Session::flash('success' , ['دسته بندی با موفقت ایجاد شد !']);
        return $this->redirect(route('brand.index'));
    }
    public function render()
    {
        $this->authorize('create' , [Brand::class , auth()->user()]);
        return view('livewire.dashboard.brand.create')->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'brand.index' , 'title' => 'برند ها'] ,
                ['name' => 'brand.create' , 'title' => 'ایجاد برند'  ] ,
            ]]
        );
    }
}
