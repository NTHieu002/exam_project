@extends('admin.admin-layout')
@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cập Nhật Sản Phẩm</h3>
            </div>


            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_content">
                            {{csrf_field()}}
                            <span class="section">Thông Tin </span>
                            
                            <form method="POST" action="{{URL::to('/admin/update-product/'.$edit_product[0]->product_id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}    
                            <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Tên Sản Phẩm<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="product_name" value="{{$edit_product[0]->product_name}}" required="required" />
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Số Lượng<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" value="{{$edit_product[0]->product_quantity}}" data-validate-length-range="6" data-validate-words="2" name="product_quantity" placeholder="Cái" required="required" />
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Giá<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control" value="{{$edit_product[0]->product_price}}" name="product_price" required="required" />
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Danh mục<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select class="form-control col-sm-6" name="product_category" id="">
                                            <option value="1">No.1 Category</option>
                                            <option value="2">No.2 Category</option>
                                            <option value="3">No.3 Category</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Trạng Thái<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select class="form-control col-sm-6" name="product_status" id="">
                                            <option value="1">Hiển Thị</option>
                                            <option value="0">Ẩn</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Hình Ảnh<span class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input accept="image/*" id="imgInp" type="file"  class="form-control" name="product_img" placeholder="Ảnh Sản Phẩm" required="required"></input>
                                        <br>    
                                        <img id="upload_img" src="{{URL::to('/public/uploads/products/'.$edit_product[0]->product_image )}}" height="200" alt="your image" />
                                    </div>
                                </div>
                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <button name="btn__update_product" type='submit' class="btn btn-primary">Cập Nhật</button>
                                            <button type='reset' class="btn btn-success">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php

                            use Illuminate\Support\Facades\Session;

                            $mess = Session::get('message');
                            if ($mess) {
                                echo $mess;
                                Session::put('message', null);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                upload_img.src = URL.createObjectURL(file)
            }
        }
    </script>
    @endsection
