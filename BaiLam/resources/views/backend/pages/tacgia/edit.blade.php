@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
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

    .theLoai {
        padding-left: 1rem !important;
    }

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
                <h4 class="page-title">Sach/The Loai</h4>
            </div>
        </div>

        <div class="white-box">
            <form id="tacgiaForm" action="{{route('tacgia.store')}}" method="post">
                {{ method_field('PUT') }}
                @csrf
               
                {{-- Nhap ten the loai --}}
                <div>
                    <label for="hoTen">Họ và tên</label>
                    <input type="text" class="form-control" required name="hoTen" id="hoTen"
                        placeholder="Tối đa 50 kí tự" value="{{$item->hoTen}}">
                </div>
                
                <div style="display: flex;">
                
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="namSinh">Năm sinh</label>
                <input type="date" class="form-control" value="{{$item->namSinh}}" required name="namSinh" id="namSinh">
                </div>
                
                
                
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="namMat">Năm mất</label>
                    <input type="date" class="form-control" value="{{$item->namMat==""?"":$item->namMat}}"  name="namMat" id="namMat">
                </div>



                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="quocTich">Quốc tịch</label>
                    <input type="text" class="form-control" value="{{$item->quocTich==""?"":$item->quocTich}}"  name="quocTich" id="quocTich"
                    placeholder="Tối đa 20 kí tự">
                </div>
            </div>
                {{-- Them mo ta ve the loai --}}
                <div style="margin-top: 2rem !important;">
                    <label for="tomTat">Tóm tắt về tác giả</label>
                    <textarea class="form-control" name="tomTat" required id="tomTat" rows="4"
                    placeholder="Tối đa 100 kí tự">{{$item->tomTat}}</textarea>
                </div>

                {{-- Bat Dau chon the loai cha--}}
                


                <div class="text-center" style="margin-top: 5rem;">
                    <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                    <button type="button" id="check" class="btn btn-primary">Lưu</button>
                    <a href="{{route('tacgia.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
                </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost='/admin/danhmuc/tacgia';
    $("#check").click(function () {
        var hl = $("#tacgiaForm").valid();
        var href =   window.location;
        var id =href.toString().split('tacgia/')[1].split('/')[0] ;
        if (hl) {
            thucHienAjax(id);
        }
    });

    $("#tacgiaForm").validate({
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
                maxlength: 50
            },
            tomTat: {
                required: true,
                maxlength: 100
            },
            quocTich:{
              
                maxlength: 20
            }


        },
        messages: {
            hoTen: {
                required: 'Bạn phải nhập trường này',
                maxlength: "Tối đa 50 kí tự"
            },
            tomTat: {
                required: 'Bạn phải nhập trường này',
                maxlength: "Tối đa 50 kí tự"
            },
            quocTich:{
                maxlength: "Tối đa 20 kí tự"
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
            'hoTen': $("#hoTen").val(),
            'tomTat': $("#tomTat").val(),
            'namSinh': $("#namSinh").val(),
            'namMat': $("#namMat").val(),
            'quocTich': $("#quocTich").val(),
            // 'theLoai': $('input[name=theLoai]:checked').val(),
        
        };
        // var obj = $("#tacgiaForm").serialize();
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

                    alertify.success('Sửa thể loại thành công');
                }
            }
        });
    }



</script>
@endsection