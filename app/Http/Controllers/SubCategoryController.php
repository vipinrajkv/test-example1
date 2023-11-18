<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    private $subCategory;
    public function __construct(
        SubCategory $subCategory
    ) {
        $this->subCategory = $subCategory;
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
            'sub_category_name' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $subCategoryData =  [
                'sub_category_name' => $request->input('sub_category_name'),
                'category_id' => $request->input('category_id'),
                'status' => $request->input('status') ?? 1,
                'created_at' => date("Y/m/d"),
                'updated_at' => date("Y/m/d"),
            ];
            $subCategory =  $this->subCategory->subCategoryCreate($subCategoryData);

            if ($subCategory) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Sub Category added successfully'
                ], 200);
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => 'Sub Category creation failed'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        $subCategory =  $this->subCategory->with('category')->get()->toArray();
        // $subCategory = SubCategory::with(['category'])->get();

        if (!empty($subCategory)) {
            return response()->json([
                'status' => 200,
                'subCategoryList' => $subCategory,
                'message' => 'Sub Category lists found',
            ], 200);
        }

        return response()->json(
            ['status' => 400,
            'message' =>  'Sub Category lists not found',
            ], 400);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(int $subCategoryId)
    {
        $subCategory =  $this->subCategory->getSubCategory($subCategoryId);

        if (!empty($subCategory)) {
            return response()->json([
                'status' => 200,
                'message' => 'SubCategory Data found',
                'subCategoryData' => $subCategory
            ], 200);
        }

        return response()->json([
            'status' => 400,
            'message' => 'SubCategory Data Not found',
        ], 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $subCategoryId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $subCategoryId)
    {
        $validator = validator::make($request->all(), [
            'sub_category_name' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $subCategoryData =  [
                'sub_category_name' => $request->input('sub_category_name'),
                'category_id' => $request->input('category_id') ?? 1,
                'status' => $request->input('status') ?? 1,
                'created_at' => date("Y/m/d"),
                'updated_at' => date("Y/m/d"),
            ];
            $subCategory =  $this->subCategory->subCategoryUpdate($subCategoryData, $subCategoryId);

            if ($subCategory) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Sub Category updated successfully'
                ], 200);
            }
                return response()->json([
                    'status' => 500,
                    'message' => 'Sub Category update failed'
                ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $subCategoryId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $subCategoryId = null)
    {
        $subCategory =  $this->subCategory->subCategoryDelete($subCategoryId);
        
        if ($subCategory) {
            return response()->json([
                'status' => 200,
                'message' => 'SubCategory deleted successfully'
            ], 200);
        }
            return response()->json([
                'status' => 500,
                'message' => 'SubCategory delete failed'
            ], 500);
    }
}
