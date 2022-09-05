<?php

namespace App\Http\Livewire\Dashboard\Brand;

use App\Models\Brand;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;
    public Brand $brand;

    protected $rules = [
        'brand.title' => 'required|string|min:4',
        'brand.label' => 'required|string|min:3',
    ];

    public function mount()
    {
        $this->brand = Brand::findOrFail(request()->id);
    }

    public function edit()
    {
        $this->validate();
        $this->validate([
            'brand.title' => [ Rule::unique('brands' , 'title')->ignore($this->brand->id)],
            'brand.label' => [ Rule::unique('brands' , 'label')->ignore($this->brand->id)],
        ]);
        $this->brand->save();
        Session::flash('success' , ['ویرایش با موفقیت انجام شد !']);
        return $this->redirect(route('brand.index'));
    }

    public function render()
    {
        $this->authorize('update' , [Brand::class , auth()->user()]);
        return view('livewire.dashboard.brand.edit')->layout('layouts.dashboard'
            , ['breads' => [
                ['name' => 'brand.index' , 'title' => ' برند ها'] ,
                ['name' => 'brand.edit' , 'title' => 'ویرایش برند' , 'params' => $this->brand->id] ,
            ]]
        );
    }
}
