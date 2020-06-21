@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    /* CUSTOM CHECBOX */
    .myRadio input[type=radio] {
        opacity: 0;
    }

    .myRadio {
        position: relative;
    }

    .myRadio .custom-tick:before {
        border: 2px black solid;
        border-radius: 50%;
        width: 14px;
        height: 14px;
        content: "";
        display: inline-block !important;
        position: absolute;
        top: 50%;
        transform: translateY(-45%);
        left: 0;
        transition: all .4s;
    }

    .myRadio .custom-tick:after {
        content: "";
        display: inline-block !important;
        position: absolute;
        display: none;
        left: 0;
        transition: all .4s;
    }

    .myRadio input[type=radio]:checked~.custom-tick:before,
    .myRadio input[type=radio]:checked~.custom-tick:after {
        height: 4px;
        display: inline-block;
        border-radius: 0;
    }

    .myRadio input[type=radio]:checked~.custom-tick:before {
        width: 9px;
        background-color: rgb(3, 43, 19);
        border: none;
        top: 8px;
        transform: rotate(40deg);
        left: 2px;
    }

    .myRadio input[type=radio]:checked~.custom-tick:after {
        width: 18px;
        background-color: rgb(12, 172, 78);
        transform: rotateZ(130deg);
        top: 7px;
        left: 7px;
    }

    .myRadio span {
        margin-left: 1.5rem;
    }

    /* HET CHECK BOX */
    body {
        font-family: 'Muli', sans-serif;
    }

    .white-box label {
        font-weight: bold;
    }

    ul.theLoai {
        border-left: 0.5px solid black;
    }

    #nhanvienForm input{
        border: none;
        box-shadow: none;
        border-bottom: solid 0.7px rgb(179, 179, 179);
    }
    #nhanvienForm input:read-only{
      background-color: white;
    }


    .table-info tr {
        display: block;
        margin-top: 2.5rem;
    }

    .avatar {
        position: relative;

    }

    .avatar img {
        display: block;
        margin: 0;
        width: 75%;
        border-radius: 50%;
        margin: 0 auto;
        margin-bottom: 1rem;
    }

    .avatar input[type=file] {
        opacity: 0;
        z-index: -1;
        position: absolute;
    }

    .avatar button {
        display: none;
    }

    .label-title{
        padding-bottom: 2rem; display: block ;border-bottom:0.7px solid rgb(187, 187, 187) ;
        font-family: 'Noto Serif', serif;
        font-size: 2rem;
    }
    .danh-sach-quyen{
        font-family: 'Roboto', sans-serif;
        font-weight: bolder;
    }
    .danh-sach-quyen li{
        padding-left: 1rem;
        margin-top: 1rem;
    }
    .danh-sach-quyen li span{
        margin-left: 1rem;
    }
    .ten-quyen{
        background-color: #2cca79;
        /* background-color: rgb(153, 153, 238); */
        padding:  0.5rem;
        border-radius: 4px;
    }
    .danh-sach-quyen p{
        font-family: 'Noto Serif', serif;
        margin-top: 1rem;
    }
</style>
@endsection
{{-- {{$html}} --}}

@section('noi-dung')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title font-noto">Cá nhân/Tài khoản</h4>
            </div>
        </div>
        {{-- {{dd($data)}} --}}
        <div class="row">
            <div class="white-box " style="padding-left: 5rem; overflow: hidden;">

                <div class="row" style="margin-bottom: 9rem;">
                    <div class="col-md-8">

                        <table class="table-info ">
                            <label class="label-title">Thông tin tài khoản</label>
                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>ID tài khoản: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span id="idTK">{{$data->id}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>Tên tài khoản: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span>{{$data->tenTaiKhoan}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>Email: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span>{{$data->email}}</span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ten-thuoc-tinh">
                                    <span>Ngày lập: </span>
                                </td>
                                <td class="gia-tri-thuoc-tinh">
                                    <span>{{ $data->ngayLap->format('d/m/Y')}}</span>
                                </td>
                            </tr>

                        </table>
                        <div class="text-center"  style="margin-top: 5rem;">
                            <button  type="button" id="check" class="btn btn-primary">Lưu</button>
                            <button  type="button"  class=" sua btn  btn-info">Sửa</button>
                            <a href="{{route('nhanvien.index')}}"> <button type="button"
                                    class="btn btn-danger">Hủy</button></a>
                            
                         </div>
                    </div>
                    <div class="col-md-4">
                        <form method="post" action="{{route('taikhoan.avatar',$data->id)}}" id='form-avatar'
                            enctype="multipart/form-data" style="margin-bottom: 4rem;">
                            @csrf
                            <div class="avatar">
                                <img src="{{asset('img/avatar/admin/'.$data->avatar)}}" />
                                <label for="photo" class="btn btn-primary">Chọn file</label>
                                <input type="file" id="photo" name="photo" accept="image/*" />
                                <button class=" btn btn-success ">Lưu</button>
                            </div>
                        </form>

                        <div style="display: flex" >
                            <a class="btn btn-danger" style="margin-right: 2rem;">Cập nhật Email</a>
                            <a class="btn btn-info">Đổi mật khẩu</a>
                            
                         </div>
                    </div>

                    
                </div>

                <div class="row" style="margin-bottom: 5rem !important; ">
                    
                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <label class="label-title">Quyền của tài khoản</label>
                        <div class = "table-info quyen">
                           <ul class="danh-sach-quyen">
                               @foreach ($data->chucvus()->get() as $item)
                                    <p>Quyền: {{$item->tenChucVu}}</p>

                                    @foreach ($item->quyens()->get() as $q)
                                    <li style="display: flex; ">
                                        <span style="width: 25%; text-align: center;" class='ten-quyen'>{{$q->tenQuyen}}</span>
                                        <span style="width: 70%;" >{{$q->moTa}}</span>
                                    </li>
                                    @endforeach
                               @endforeach
                             
                           </ul>
                        </div>   
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
@section('footer')
@parent
<script>
    function choPhepNhap(choPhep){
        $('#nhanvienForm input').prop('readonly',!choPhep);
    }    
    const urlPost = '/admin/danhmuc/nhanvien';
    $(document).ready(function (e) {
        choPhepNhap(false);   
    }
    );

  
    $("#check").click(function () {
        var hl = $("#nhanvienForm").valid();
        var href = window.location;
        var id = href.toString().split('nhanvien/')[1].split('/')[0];
        if (hl) {
            thucHienAjax(id);
        }
    });

    $('#nhanvienForm .sua').click(function(){
        $(this).removeClass('sua');
        choPhepNhap(true);
        $(this).text('Reset');
        $(this).prop('type','reset');
        $(this).addClass('reset');
    });

    $("#nhanvienForm").validate({
        onfocusout: function (element) {
            if ($(element).val() == "") return;
            var hl = $(element).valid();
            if (hl) {

                if ($(element).hasClass('is-invalid'))
                    $(element).removeClass("form-control is-invalid");
                $(element).addClass('form-control is-valid');
            }
        }, onkeyup: false,
        rules: {
            hoTen: {
                required: true,
                // minlength: 7,
                maxlength: 50,

            },
            chucVu: {
                required: true,
                minlength: 3,
                maxlength: 30,

            },
            namSinh: {
                min: '1950',
                max: '2020',
                required: true
            },
            cmnd: {
                required: true,
                minlength: 6,
                maxlength: 30
            },
            diaChi: {
                required: true,
                minlength: 1,
                maxlength: 50
            },
            sdt: {
                required: true,
                minlength: 7,
                maxlength: 11
            },
            email: {
                required: true,
                minlength: 1,
                maxlength: 50
            },
        },
        messages: {
            hoTen: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 50 kí tự'
            },
            chucvu: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 3 kí tự',
                maxlength: 'Tối đa 30 kí tự'
            },
            namSinh: {
                min: 'Năm sinh quá lâu, chém gió à',
                max: 'Năm sinh lớn hơn hiện tại, chém gió à',
                required: 'Không được bỏ trống'
            },
            cmnd: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 6 kí tự',
                maxlength: 'Tối đa 30 kí tự'
            },
            diaChi: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 1 kí tự',
                maxlength: 'Tối đa 50 kí tự'
            },
            sdt: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 11 kí tự'
            },
            email: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 1 kí tự',
                maxlength: 'Tối đa 40 kí tự'
            },
        }, errorPlacement: function (err, elemet) {

            err.insertAfter(elemet);
            err.addClass('invalid-feedback d-inline text-danger');
            elemet.addClass('form-control is-invalid');
            $('.focus-input100-1,.focus-input100-2').addClass('hidden');
        }
    }
    );
    function thucHienAjax(id) {
        var obj = {
            'hoTen': $("#hoTen").val(),
            'chucVu': $("#chucVu").val(),
            'namSinh': $("#namSinh").val(),
            'cmnd': $("#cmnd").val(),
            'diaChi': $("#diaChi").val(),
            'sdt': $("#sdt").val(),
            'gioiTinh' :$("input[name=gioiTinh]:checked").val(),
            'ID_Admin': 1,

        };
        // var obj = $("#nhanvienForm").serialize();
        console.log(obj);

        $.ajax({
            type: "post",
            method: 'put',
            url: urlPost + '/' + id,
            data: obj,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                if (response.yes === true) {
                    alertify.success('Sửa nhân viên thành công');
                }
            }
        });
    }



</script>
@endsection