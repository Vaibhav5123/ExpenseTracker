<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    use SoftDeletes;
    protected $categoryservice;

    public function __construct(CategoryService $service)
    {
        $this->categoryservice = $service;
    }

    public function index() 
    { 
        $categories = $this->categoryservice->All();
        return view('category.category-view', compact('categories')); 
    }

    public function show($id) 
    { 
        $category = $this->categoryservice->find($id);

        return view('category.category-show', compact('category')); 
    }

    public function create() 
    { 
        return view('category.category-add'); 
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        $category = $this->categoryservice->create($data);

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $category = $this->categoryservice->find($id);
        return view('category.category-edit', compact('category'));
    }

    public function update(StoreCategoryRequest $request, $id)
    {
        $data = $request->validated();

        $category = $this->categoryservice->update($id, $data);

        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $result = $this->categoryservice->delete($id);
        return redirect()->route('category.index');
    }
}
