@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
   
    body {
        font-family: 'Muli', sans-serif;
    }

    .white-box label {
        font-weight: bold;
    }

    ul.theLoai {
        border-left: 0.5px solid black;
    }
</style>
@endsection
{{-- {{$html}} --}}

@section('noi-dung')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Quyen</h4>
            </div>
        </div>

        <div class="white-box">
            <form id="quyenForm" action="{{route('quyen.store')}}" method="post">
                {{ method_field('PUT') }}
                @csrf
               
                {{-- Nhap ten the loai --}}
                <div>
                    <label for="maQuyen">Mã quyền</label>
                    <input type="text" class="form-control" required name="maQuyen" id="maQuyen"
                        placeholder="Tối đa 30 kí tự" value="{{$item->maQuyen}}">
                </div>
                
                <div style="display: flex;">
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="tenQuyen">Tên quyền</label>
                    <input type="text" class="form-control" placeholder="Tối đa 30 kí tự" value="{{$item->tenQuyen}}" required name="tenQuyen" id="tenQuyen">
                </div>



                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="moTa">Mô tả</label>
                    <input type="text" class="form-control" value="{{$item->moTa}}" name="moTa" id="moTa">
                </div>
                

                
            </div>
                {{-- Bat Dau chon the loai cha--}}
                


                <div class="text-center" style="margin-top: 5rem;">
                    <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                    <button type="button" id="check" class="btn btn-primary">Lưu</button>
                    <a href="{{route('quyen.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost='/admin/danhmuc/quyen';
    $("#check").click(function () {
        var hl = $("#quyenForm").valid();
        var href =   window.location;
        var id =href.toString().split('quyen/')[1].split('/')[0] ;
        if (hl) {
            thucHienAjax(id);
        }
    });

    $("#quyenForm").validate({
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
            maQuyen: {
                required: true,
                minlength: 7,
                maxlength: 30
            },
            tenQuyen: {
                required: true,
                minlength: 7,
                maxlength: 30
            },
            moTa: {
                minlength: 7,
            }
        },
        messages: {
            maQuyen: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 30 kí tự'
            },
            tenQuyen: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 30 kí tự'
            },
            moTa:{
                minlength: 'Ít nhát 7 kí tự',
            }
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
            'maQuyen': $("#maQuyen").val(),
            'tenQuyen': $("#tenQuyen").val(),
            'moTa': $("#moTa").val(),
            // 'theLoai': $('input[name=theLoai]:checked').val(),
        
        };
        // var obj = $("#quyenForm").serialize();
        console.log(obj);
        
        $.ajax({
            type: "post",
            method:'put',
            url: urlPost+'/'+id,
            data: obj,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                if (response.yes === true) {

                //    var now = new Date();
                //     $("#hoTen").val("");
                //     $("#namSinh").val( Date.now());
                //     $("#namMat").val(new Date (now.getTime()));
                //     $("#quocTic").val("");
                //     $("#tomTat").val("");

                    alertify.success('Sửa quyền thành công');
                }
            }
        });
    }



</script>
@endsection