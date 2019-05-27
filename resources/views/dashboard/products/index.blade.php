@section('styles')
@endsection

@extends('dashboard.index')
@section('title')
    المنتجات
@endsection
@section('content')

    <div class="btn-group btn-group-justified m-b-10">
        <a href="#add" class="btn btn-success waves-effect btn-lg waves-light" data-animation="fadein" data-plugin="custommodal"
            data-overlaySpeed="100" data-overlayColor="#36404a">اضافة منتج جديد <i class="fa fa-plus"></i> </a>
        <a href="#deleteAll" class="btn btn-danger waves-effect btn-lg waves-light delete-all" data-animation="blur" data-plugin="custommodal"
            data-overlaySpeed="100" data-overlayColor="#36404a">حذف المحدد <i class="fa fa-trash"></i> </a>
        <a class="btn btn-primary waves-effect btn-lg waves-light" onclick="window.location.reload()" role="button">تحديث الصفحة <i class="fa fa-refresh"></i> </a>
    </div>

    <div class="row">

        <div class="col-sm-12">
            <div class="card-box table-responsive boxes">

                <table id="datatable" class="table table-bordered table-responsives">
                    <thead>
                    <tr>
                        <th>
                            <label class="custom-control material-checkbox" style="margin: auto">
                                <input type="checkbox" class="material-control-input" id="checkedAll">
                                <span class="material-control-indicator"></span>
                            </label>
                        </th>
                        <th>الرقم</th>
                        <th>الاسم</th>
                        <th>اسم المستخدم</th>
                        <th>رقم الهاتف</th>
                        <th>القسم</th>
                        <th>النوع</th>
                        <th>السعر</th>
                        <th>عدد المشاهدات</th>
                        <th>عدد الطلبات</th>
                        <th>التاريخ</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <label class="custom-control material-checkbox" style="margin: auto">
                                    <input type="checkbox" class="material-control-input checkSingle" id="{{$product->id}}">
                                    <span class="material-control-indicator"></span>
                                </label>
                            </td>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->user->name}}</td>
                            <td>{{$product->user->phone}}</td>
                            <td>{{$product->category->name_ar}}</td>
                            <td>
                                @if($product->type == 1)
                                    شراء
                                @elseif($product->type == 2)
                                    مزايدة
                                @elseif($product->type == 3)
                                    مبادلة
                                @elseif($product->type == 4)
                                    مبادلة بفرق سعر
                                @endif
                            </td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->views()->count()}}</td>
                            <td>{{$product->orders()->count()}}</td>
                            <td>{{$product->created_at->diffForHumans()}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="#edit" class="edit btn btn-success" data-animation="fadein" data-plugin="custommodal"
                                        data-overlaySpeed="100" data-overlayColor="#36404a"
                                        data-id = "{{$product->id}}"
                                        data-name = "{{$product->name}}"
                                        data-desc = "{{$product->desc}}"
                                        data-price = "{{$product->price}}"
                                        data-category_id = "{{$product->category_id}}"
                                        data-type = "{{$product->type}}"
                                        data-user_id = "{{$product->user_id}}"
                                        data-exchange_price = "{{$product->exchange_price}}"
                                        data-exchange_product = "{{$product->exchange_product}}"
                                        data-max_price = "{{$product->max_price}}"
                                    >
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                    <a href="#delete" class="delete btn btn-danger" data-animation="blur" data-plugin="custommodal"
                                        data-overlaySpeed="100" data-overlayColor="#36404a"
                                        data-id = "{{$product->id}}"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->

    </div>

    <!-- add user modal -->
    <div id="add" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title" style="background-color: #36404a">
            منتج جديد
        </h4>
        <form action="{{route('addCategory')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">الاسم</label>
                            <input type="text" autocomplete="nope" name="name" required class="form-control" placeholder="الاسم ...">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">الوصف</label>
                            <textarea name="desc" placeholder="وصف المنتج ..." id="" cols="30" rows="10" required class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="user_id" id="" class="form-control">
                                <option value="">--اختر المستخدم--</option>
                                <option value="">shams</option>
                                <option value="">mohamed</option>
                                <option value="">dam</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="category_id" id="" class="form-control">
                                <option value="">--اختر القسم--</option>
                                <option value="">shams</option>
                                <option value="">mohamed</option>
                                <option value="">dam</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <select name="category_id" id="" class="form-control">
                                <option value="">--اختر النوع--</option>
                                <option value="1">شراء</option>
                                <option value="2">مزايدة</option>
                                <option value="3">تبادل</option>
                                <option value="4">تبادل مع فرق السعر</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="price">
                        <label for="field-1" class="control-label">السعر</label>
                        <input type="number" name="price" class="form-control" placeholder="السعر ...">
                    </div>
                    <div class="form-group" id="auction">
                        <label for="field-1" class="control-label">سعر المزايدة</label>
                        <input type="number" name="auction" class="form-control" placeholder="السعر المزايدة ...">
                    </div>
                    <div class="form-group" id="exchange_product">
                        <label for="field-1" class="control-label">منتج المبادلة</label>
                        <input type="text" name="exchange_product" class="form-control" placeholder="منتج المبادلة ...">
                    </div>
                    <div class="form-group" id="extra_price">
                        <label for="field-1" class="control-label">فرق السعر</label>
                        <input type="number" name="extra_price" class="form-control" placeholder="فرق السعر ...">
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-4 control-label">صورة القسم</label>
                                <input type="file" name="image" class="dropify" data-max-file-size="1M">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect waves-light">اضافة</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="Custombox.close();">رجوع</button>
            </div>
        </form>
    </div>

    <!-- edit user modal -->
    <div id="edit" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title" style="background-color: #36404a">
            تعديل <span id="category"></span>
        </h4>
        <form id="edit" action="{{route('updateCategory')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">الاسم بالعربية</label>
                            <input type="text" autocomplete="nope" name="name_ar" required class="form-control" placeholder="الاسم بالعربية ...">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label">الاسم بالانجليزية</label>
                            <input type="text" autocomplete="nope" name="name_en" required class="form-control" placeholder="الاسم بالانجليزية ...">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-4 control-label">صورة القسم</label>
                                <input type="file" name="image" class="dropify" data-max-file-size="1M">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect waves-light">تعديل</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="Custombox.close();">رجوع</button>
            </div>
        </form>
    </div>


    <div id="delete" class="modal-demo" style="position:relative; right: 32%">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title">حذف عضو</h4>
        <div class="custombox-modal-container" style="width: 400px !important; height: 160px;">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin-top: 35px">
                        هل تريد مواصلة عملية الحذف ؟
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{route('deleteCategory')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="delete_id" value="">
                        <button style="margin-top: 35px" type="submit" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5" style="margin-top: 19px">حـذف</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>

    <div id="deleteAll" class="modal-demo" style="position:relative; right: 32%">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title">حذف المحدد</h4>
        <div class="custombox-modal-container" style="width: 400px !important; height: 160px;">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin-top: 35px">
                        هل تريد مواصلة عملية الحذف ؟
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button style="margin-top: 35px" type="submit" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5 send-delete-all" style="margin-top: 19px">حـذف</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>

@endsection

@section('script')


    <script>


		$('.edit').on('click',function() {

			let id      = $(this).data('id');
			let name_ar = $(this).data('name_ar');
			let name_en = $(this).data('name_en');
			let image   = $(this).data('image');


            $('#edit').find("input[name='id']").val(id);
            $('#edit').find("input[name='name_ar']").val(name_ar);
            $('#edit').find("input[name='name_en']").val(name_en);
            $('#edit').find("input[name='name_ar']").val(name_ar);
			let link = "{{asset('images/categories/')}}" + '/' + image;
			$('.photo').attr('data-default-file', link);
			$("#category").html(name_ar);
		});

		$('.delete').on('click',function(){

			let id         = $(this).data('id');
			$("input[name='delete_id']").val(id);

		});

		$("#checkedAll").change(function(){
			if(this.checked){
				$(".checkSingle").each(function(){
					this.checked=true;
				})
			}else{
				$(".checkSingle").each(function(){
					this.checked=false;
				})
			}
		});

		$(".checkSingle").click(function () {
			if ($(this).is(":checked")){
				var isAllChecked = 0;
				$(".checkSingle").each(function(){
					if(!this.checked)
						isAllChecked = 1;
				})
				if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }
			}else {
				$("#checkedAll").prop("checked", false);
			}
		});

		$('.send-delete-all').on('click', function (e) {

			var categoriesIds = [];
			$('.checkSingle:checked').each(function () {
				var id = $(this).attr('id');
                categoriesIds.push({
					id: id,
				});
			});
			var requestData = JSON.stringify(categoriesIds);
			// console.log(requestData);
			if (categoriesIds.length > 0) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: "{{route('deleteCategories')}}",
					data: {data: requestData, _token: '{{csrf_token()}}'},
					success: function( msg ) {
						if (msg == 'success') {
							location.reload()
						}
					}
				});
			}
		});

		$(document).ready(function () {
            $('#price').fadeOut();
            $('#auction').fadeOut();
            $('#exchange_product').fadeOut();
            $('#extra_price').fadeOut();
        });

		$('select[name="category_id"]').change(function () {
            var type = $(this).val();

            $('#price').fadeOut();
            $('#auction').fadeOut();
            $('#exchange_product').fadeOut();
            $('#extra_price').fadeOut();

            if (type == 1){
                $('#price').fadeIn()
            } else if (type == 2){
                $('#auction').fadeIn()
            } else if (type == 3){
                $('#exchange_product').fadeIn()
            } else if (type == 4){
                $('#exchange_product').fadeIn();
                $('#extra_price').fadeIn();
            }else {
                $('#price').fadeOut();
                $('#auction').fadeOut();
                $('#exchange_product').fadeOut();
                $('#extra_price').fadeOut();
            }
        })
    </script>

@endsection
