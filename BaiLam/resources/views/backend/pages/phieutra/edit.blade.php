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
                <h4 class="page-title">Phieu Tra</h4>
            </div>
        </div>

        <div class="white-box">
            <form id="phieutraForm" action="{{route('phieutra.store')}}" method="post">
                {{ method_field('PUT') }}
                @csrf
               
                {{-- Nhap ten the loai --}}
                <div>
                    <label for="selectPhieuMuon">Phiếu Mượn</label>
                    <select class="form-control" id="selectPhieuMuon" name="selectPhieuMuon" required>
                            <!-- <option value="" disabled selected>Chọn tên độc giả</option> -->
                            @foreach($itemphieumuon as $items)
                            <option value="{{$items->id}}">{{$items->id}}</option>
                            @endforeach
                    </select>
                </div>
                
                <div style="display: flex;">
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="ngayTra">Ngày Trả</label>
                    <input type="date" class="form-control" value="{{$item->ngayTra}}" required name="ngayTra" id="ngayTra">
                </div>

                
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="selectDocGia">Nhân Viên</label>
                    <select class="form-control" id="selectNhanVien" name="selectNhanVien" required>
                            <!-- <option value="" disabled selected>Chọn tên độc giả</option> -->
                            @foreach($itemnhanvien as $items)
                            <option value="{{$items->id}}">{{$items->hoTen}}</option>
                            @endforeach
                    </select>
                </div>

            </div>

                <div class="text-center" style="margin-top: 5rem;">
                    <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                    <button type="button" id="check" class="btn btn-primary">Lưu</button>
                    <a href="{{route('phieutra.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost='/admin/danhmuc/phieutra';
    $("#check").click(function () {
        var hl = $("#phieutraForm").valid();
        var href =   window.location;
        var id =href.toString().split('phieutra/')[1].split('/')[0] ;
        if (hl) {
            thucHienAjax(id);
        }
    });

    // $("#phieutraForm").validate({
    //     onfocusout: function (element) {
    //         if ($(element).val() == "") return;
    //         var hl = $(element).valid();
    //         if (hl) {

    //             if ($(element).hasClass('is-invalid'))
    //                 $(element).removeClass("form-control is-invalid");
    //             $(element).addClass('form-control is-valid');
    //         }
    //     }, onkeyup: false,
    //     rules:
    //         ngayMuon: {
    //             required:true
    //         },
    //     },
    //     messages: {
    //         ngayMuon: {
    //             required:'Không được bỏ trống'
    //         },
    //     }, errorPlacement: function (err, elemet) {
        
    //     err.insertAfter(elemet);    
    //     err.addClass('invalid-feedback d-inline text-danger');
    //     elemet.addClass('form-control is-invalid');
    //     $('.focus-input100-1,.focus-input100-2').addClass('hidden');
    // }
    //});
    
    function thucHienAjax(id) {
        var obj = {
            'ngayTra': $("#ngayTra").val(),
            'ID_PhieuMuon': $("#selectPhieuMuon").children('option:selected').val(),
            'ID_NhanVien': $("#selectNhanVien").children('option:selected').val(),
        };
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
                    alertify.success('Sửa phiếu trả thành công');
                }
            }
        });
    }



</script>
@endsection