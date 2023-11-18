<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $category;
    public function __construct(
        Category $category
    ) {
        $this->category = $category;
    }

    /**
     * Show the form for creating category.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $categoryData =  [
                'category_name' => $request->input('category_name'),
                'status' => $request->input('status') ?? 1,
                'created_at' => date("Y/m/d"),
                'updated_at' => date("Y/m/d"),
            ];
            $category =  $this->category->categoryCreate($categoryData);

            if ($category) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Category added successfully'
                ], 200);
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => 'Category creation failed'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category =  $this->category->getCategoryList();

        if (!empty($category)) {
            return response()->json([
                'status' => 200,
                'categoryList' => $category,
                'message' => 'Category lists found',
            ], 200);
        }

        return response()->json(
            ['status' => 400,
            'message' =>  'Category lists not found',
            ], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $categoryId)
    {
        $category =  $this->category->getCategoryItem($categoryId);

        if (!empty($category)) {
            return response()->json([
                'status' => 200,
                'message' => 'Category Data found',
                'CategoryData' => $category
            ], 200);
        }

        return response()->json([
            'status' => 400,
            'message' => 'Category Data Not found',
        ], 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $categoryId)
    {
        $validator = validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->fails()) {
            
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $categoryData =  [
                'category_name' => $request->input('category_name'),
                'status' => $request->input('status') ?? 1,
            ];
            $category =  $this->category->categoryUpdate($categoryData, $categoryId);

            if ($category) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Category updated successfully'
                ], 200);
            }
                return response()->json([
                    'status' => 500,
                    'message' => 'Category update failed'
                ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $categoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $categoryId = null)
    {
        $category =  $this->category->categoryDelete($categoryId);
        
        if ($category) {
            return response()->json([
                'status' => 200,
                'message' => 'Category deleted successfully'
            ], 200);
        }
            return response()->json([
                'status' => 500,
                'message' => 'Category delete failed'
            ], 500);
    }
}
