<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreProduct;
use App\Product;
use App\Category;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_options = Category::pluck('name', 'id');

        return view('product.create', compact('categories_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $name_file = null;
 
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
             
            $name = uniqid(date('HisYmd'));
     
            $extension = $request->image->extension();
     
            $name_file = "{$name}.{$extension}";
     
            $upload = $request->image->storeAs('public/products', $name_file);
            //storage/app/public/products/name.ext
     
            if ( !$upload ) {
                return redirect()
                    ->back()
                    ->with('error', 'Upload failrule.')
                    ->withInput();
            }
        }

        $requestData = $request->all();
        $requestData['price'] = floatval(str_replace(',', '.', str_replace('.', '', $request->price)));
        $requestData['image'] = $name_file ? $name_file : null;

        if ($product = Product::create($requestData)) {
            return redirect()
                ->route('products.edit', ['id' => $product->id])
                ->with('success', 'Product saved successfully!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong.')
                ->withInput();
        }
    }

    /**
     * Show the resource details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories_options = Category::pluck('name', 'id');

        return view('product.edit', compact('product', 'categories_options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\StoreProduct  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, $id)
    {
        $product = Product::find($id);

        $validated = $request->validated();
        
        $name_file = null;
 
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
             
            $name = uniqid(date('HisYmd'));
     
            $extension = $request->image->extension();
     
            $name_file = "{$name}.{$extension}";
     
            $upload = $request->image->storeAs('public/products', $name_file);
            //storage/app/public/products/name.ext
     
            if ( !$upload ) {
                return redirect()
                    ->back()
                    ->with('error', 'Upload failrule.')
                    ->withInput();
            }
        }

        $requestData = $request->all();
        $requestData['price'] = floatval(str_replace(',', '.', str_replace('.', '', $request->price)));

        if ($name_file) {
            $requestData['image'] = $name_file;
        } else {
          unset($requestData['image']);
        }

        if ($product->update($requestData)) {
            return redirect()
                ->route('products.edit', ['id' => $product->id])
                ->with('success', 'Product updated successfully!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $image_file_name = $product->image;

        if ($product->delete()) {
            File::delete('storage/products/' . $image_file_name);

            return redirect()
                ->route('products.index')
                ->with('success', 'Product deleted successfully!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong.')
                ->withInput();
        }
    }
}
