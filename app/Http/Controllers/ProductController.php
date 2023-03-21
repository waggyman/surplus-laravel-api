<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit', 10);
        return Product::with(['categories', 'images'])->paginate($limit)->withQueryString();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'enable' => true
        ]);

        $file = $request->file('image');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $upload = Storage::disk('my_files')->put('images', $file);
        Storage::disk('my_files')->move($upload, 'images/'. $fileName);
        
        $imageDate = [
            'name' => $fileName,
            'file' => '/images/'.$fileName,
            'enable' => true
        ];

        $image = Image::create($imageDate);
        $image->products()->attach($product->id);
        
        $existingCategory = [];

        foreach ($request->get('category') as $cat) {
            $find = Category::where('name', $cat)->first();
            if ($find) {
                array_push($existingCategory, $find->id);
            } else {
                $newCategory = Category::create([
                    'name' => $cat,
                    'enable' => true
                ]);
                array_push($existingCategory, $newCategory->id);
            }
        }

        $product->categories()->attach($existingCategory);
        return $product;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['categories', 'images'])->findOrFail($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $productData = [
            'name' => $request->get('name', $product->name),
            'description' => $request->get('description', $product->description),
            'enable' => $request->get('enable', $product->enable)
        ];
        Product::where('id', $id)->update($productData);

        $file = $request->file('image');
        if ($file) {
            $fileName = time() . '-' . $file->getClientOriginalName();
            $upload = Storage::disk('my_files')->put('images', $file);
            Storage::disk('my_files')->move($upload, 'images/'. $fileName);
            
            $imageDate = [
                'name' => $fileName,
                'file' => '/images/'.$fileName,
                'enable' => true
            ];

            $image = Image::create($imageDate);
            $product->images()->sync([$image->id]);
        }

        $categories = $request->get('category', []);
        $existingCategory = [];

        foreach ($categories as $cat) {
            $find = Category::where('name', $cat)->first();
            if ($find) {
                array_push($existingCategory, $find->id);
            } else {
                $newCategory = Category::create([
                    'name' => $cat,
                    'enable' => true
                ]);
                array_push($existingCategory, $newCategory->id);
            }
        }
        if (count($categories) > 0) {
            $product->categories()->sync($existingCategory);
        }
        

        return Product::findOrFail($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id);
        Product::where('id', $id)->delete();
        return response('', 204);
    }
}
