<?php

namespace App\Repositories;

use App\Models\Category;
use App\Utils\ImageUpload;

class CategoryRepository
{

    public $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function baseQuery($relations)
    {
        return $this->category->select('*')->with($relations);
    }


    public function getMainCategories()
    {
        return $this->category->where('parent_id',0)->get();
    }

    public function store($params)
    {
        return $this->category->create($params);
    }

    public function getById($id , $childrenCount = false)
    {
        $query = $this->category->where('id',$id);
        if ($childrenCount) {
            $query->withCount('child');
        }
        return $query->firstOrFail();
    }

    public function update( $id ,$params )
    {
        $category = $this->getById($id);

        return $category->update($params);
    }


    public function delete($params)
    {
        $category = $this->getById($params['id']);
        return $category->delete();
    }

}
