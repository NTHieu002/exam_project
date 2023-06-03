<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    /**
     * All Product
     *
     * @return response()
     */
    public function index()
    {
        $all_product = DB::table('tbl_products')->get();
        return view('admin.pages.all-product')->with('all_product', $all_product);
    }

    /**
     * Add Product
     *
     * @return response()
     */
    public function add_product()
    {
        return view('admin.pages.add-product');
    }

    /**
     * save Product
     *
     * @return response()
     */
    public function save_product(Request $request)
    {
        $product = new tbl_Product;
        $product->product_id = uniqid('prod-');
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_quantity = $request->product_quantity;
        $product->category_id = $request->product_category;
        $product->product_status = $request->product_status;


        $get_image = $request->file('product_img');
        $file = $get_image->getClientOriginalName();
        $file_name = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $product_img = $file_name . '.' . $extension;

        $get_image->move('public/uploads/products', $product_img);
        $product->product_image = $product_img;
        $product->save();
        Session::put('message', 'Thêm Sản Phẩm Thành Công');

        return Redirect::to('/admin/all-product');
    }

    /**
     * un active Product
     *
     * @return response()
     */
    public function unActive_product($product_id)
    {
        $product = tbl_Product::find($product_id);
        $product->product_status = 0;
        $product->save();
        Session::put('message', 'Đã cập nhật hiển thị');
        return Redirect::to('/admin/all-product');
    }
    /**
     * active Product
     *
     * @return response()
     */
    public function active_product($product_id)
    {
        $product = tbl_Product::find($product_id);
        $product->product_status = 1;
        $product->save();
        Session::put('message', 'Đã cập nhật hiển thị');
        return Redirect::to('/admin/all-product');
    }

    /**
     * delete Product
     *
     * @return response()
     */

    public function delete_product($product_id)
    {
        $product = tbl_Product::find($product_id);
        $product->delete();
        Session::put('message', 'Đã xóa thành công');
        return Redirect::to('/admin/all-product');
    }


    /**
     * edit Product
     *
     * @return response()
     */
    public function edit_product($product_id)
    {
        $edit_product =  DB::table('tbl_products')->where('product_id', $product_id)->get();
        Session::put('message', 'Đã cập nhật thành công');
        return view('admin.pages.edit-product')->with('edit_product', $edit_product);
    }

    /**
     * update Product
     *
     * @return response()
     */
    public function update_product(Request $request, $product_id)
    {
        $product = tbl_Product::find($product_id);
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->product_quantity = $request->product_quantity;
        $product->category_id = $request->product_category;
        $product->product_status = $request->product_status;


        $get_image = $request->file('product_img');
        $file = $get_image->getClientOriginalName();
        $file_name = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        $product_img = $file_name . '.' . $extension;

        $get_image->move('public/uploads/products', $product_img);
        $product->product_image = $product_img;
        $product->save();
        Session::put('message', 'Thêm Sản Phẩm Thành Công');

        return Redirect::to('/admin/all-product');
    }


    /**
     * list Product with price range
     *
     * @return response()
     */
    public function list_product(Request $request)
    {
        $min = $request->min;
        $max = $request->max;
        $validator = Validator::make([$min, $max], [
            'min' => 'required', 'max' => 'required'
        ]);
        if($validator->fails()){
            $arr = [
              'success' => false,
              'message' => 'Lỗi kiểm tra dữ liệu',
              'data' => $validator->errors()
            ];
            return response()->json($arr, 200);
        }
        $products = DB::table('tbl_products')->where('product_price', '>=', $min)->where('product_price', '<=', $max)->get();
        $arr = [
            'status' => true,
            'message' => "Danh sách sản phẩm",
            'data' => $products,
        ];
        return response()->json($arr, 200);
    }
}
