<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\CategoryDeleteRequest;
use App\Http\Requests\Dashboard\Categories\CategoryStoreRequest;
use App\Http\Requests\Dashboard\Categories\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoriesController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $mainCategories = $this->categoryService->getMainCategories();
        return view('dashboard.Categories.index',compact('mainCategories'));
    }

    public function getall()
    {
        return $this->categoryService->datatable();
    }


    public function store(CategoryStoreRequest $request)
    {
     $this->categoryService->store($request->validated());
     return redirect()->route('dashboard.categories.index');
    }


    public function edit($id)
    {
       $category = $this->categoryService->getById($id,true);
       $mainCategories = app(CategoryService::class)->getMainCategories();
       return view('dashboard.Categories.edit',compact('mainCategories','category'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
         $this->categoryService->update($request->validated(),$id);

        return redirect()->route('dashboard.categories.edit',$id);


    }


    public function delete(CategoryDeleteRequest $request)
    {
        $this->categoryService->delete($request->validated());
        return redirect()->route('dashboard.categories.index');
    }
}
