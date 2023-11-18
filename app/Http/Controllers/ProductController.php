<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $product;

    /**
     * Undocumented function
     *
     * @param Product $product
     */
    public function __construct(
        Product $product
    ) {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating product.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $img_name = $request->file('image');
            $image = time() . '.' . $img_name->getClientOriginalExtension();
            $destinationPath = public_path('/upimages');
            $img_name->move($destinationPath, $image);
            $productData =  [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'image' => $image,
            ];

            $product =  $this->product->productCreate($productData);

            if ($product) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Product added successfully'
                ], 200);
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $products =  $this->product->getProductList();

        if (!empty($product)) {

            return response()->json([
                'status' => 200,
                'productsList' => $products,
                'message' => 'Product lists found',
            ], 200);
        }

        return response()->json(
            [
                'status' => 400,
                'message' => 'Product lists not found',
            ],
            400
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $productId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $productId)
    {
        $product =  $this->product->getProduct($productId);

        if ($product) {
            return response()->json(
                [   
                    'status' => 200,
                    'productItems' => $product
            ], 200);
        }

        return response()->json(
            [
                'status' => 400,
                'message' => 'Product Item not found',
            ],
            400
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $productId)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {
            $img_name = $request->file('image');
            $image = time() . '.' . $img_name->getClientOriginalExtension();
            $destinationPath = public_path('/upimages');
            $img_name->move($destinationPath, $image);
            $productData =  [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'image' => $image,
                ''
            ];
            $product =  $this->product->productUpdate($productData, $productId);

            if ($product) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Product added successfully'
                ], 200);
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong'
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $productId = null)
    {
        $productData =  $this->product->getProduct($productId);
        $filePath = public_path('/upimages' . '/' . $productData->image);

        if (file_exists($filePath)) {
            unlink($filePath);
            $product =  $this->product->productDelete($productId);
        } else {
            $product =  $this->product->productDelete($productId);
        }

        if ($product) {
            return response()->json([
                'status' => 200,
                'message' => 'Product deleted successfully'
            ], 200);
        } else {

            return response()->json([
                'status' => 500,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
