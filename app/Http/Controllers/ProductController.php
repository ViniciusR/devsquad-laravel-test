<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use \Illuminate\Support\Facades\Storage;
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
 
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
             
            $image_file_name = null;

            if ($image_file_name = $this->uploadImage($request)) {
                $request_data = $request->all();
                $request_data['price'] = floatval(str_replace(',', '.', str_replace('.', '', $request->price)));
                $request_data['image'] = $image_file_name;

                if ($product = Product::create($request_data)) {
                    return redirect()
                            ->route('products.edit', ['id' => $product->id])
                            ->with('success', 'Product saved successfully!');
                } else {
                    return redirect()
                            ->back()
                            ->withErrors('Something went wrong. Please, try again.')
                            ->withInput();
                }
            } else {
                return redirect()
                        ->back()
                        ->withErrors('Upload failrule. Please, try again.')
                        ->withInput();
            }
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
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
             
            $image_file_name;

            if (!$image_file_name = $this->uploadImage($request)) {
                return redirect()
                        ->back()
                        ->with('error', 'Upload failrule.')
                        ->withInput();
            }
        }

        $requestData = $request->all();
        $requestData['price'] = floatval(str_replace(',', '.', str_replace('.', '', $request->price)));

        if ($image_file_name) {
            $requestData['image'] = $image_file_name;
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
                    ->withErrors('Something went wrong.')
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
                    ->withErrors('Something went wrong.')
                    ->withInput();
        }
    }

    /**
    * Uploads an image from the POST data.
    * @return the uploaded file name or false if the upload fails.
    **/
    protected function uploadImage(Request $request)
    {
        $name = uniqid(date('HisYmd'));
        $extension = $request->image->extension();
        $file_name = "{$name}.{$extension}";
 
        $upload = $request->image->storeAs('public/products', $file_name);

        if ($upload)
            return $file_name;

        return false;
    }

    /**
     * Uploads a CSV file.
     *
     * @param  \Illuminate\Http\StoreProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadCSV(Request $request)
    {
        $validatedData = $request->validate([
            'csv' => 'required|mimes:csv', //required, max 10000kb, csv file',
        ]);

        $name = uniqid(date('HisYmd'));
        $extension = $request->csv->extension();
        $file_name = "{$name}.{$extension}";
 
        $upload = $request->csv->storeAs('public/csv', $file_name);

        if ($upload)
            return redirect()
                    ->route('products.index')
                    ->with('success', 'Products imported successfully!');

        return redirect()
                ->route('products.index')
                ->withErrors('Something went wrong. Please, try again.');
    }



    function csvToArray($filename = '', $delimiter = ';')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        dd($data);

        return $data;
    }

    function getFiles() 
    {
        $csv_files = Storage::disk('public')->files('csv');

        foreach ($csv_files as $file) {            
            $this->csvToArray('storage/'.$file, ';');
        }
    }
}
