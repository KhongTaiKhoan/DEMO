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
                <h4 class="page-title">Phieu Muon</h4>
            </div>
        </div>

        <div class="white-box">
            <form id="phieumuonForm" action="{{route('phieumuon.store')}}" method="post">
                @csrf
                {{-- Nhap ten Phieu Muon --}}
                
                <div>
                    <label for="ngayMuon">Ngày Mượn</label>
                    <input type="date" class="form-control" required name="ngayMuon" id="ngayMuon">
                </div>
                
                <div style="display: flex;">
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="ngayHenTra">Ngày Hẹn Trả</label>
                <input type="date" class="form-control" required name="ngayHenTra" id="ngayHenTra">
                </div>

                
                
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="selectDocGia">Độc Giả</label>
                    <select class="form-control" id="selectDocGia" name="selectDocGia" required>
                            <!-- <option value="" disabled selected>Chọn tên độc giả</option> -->
                            @foreach($itemdocgia as $item)
                            <option value="{{$item->id}}">{{$item->hoTen}}</option>
                            @endforeach
                    </select>
                </div>



                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="selectNhanVien">Nhân Viên</label>
                    <select class="form-control" id="selectNhanVien" name="selectNhanVien" required>
                            <!-- <option value="" disabled selected>Chọn tên độc giả</option> -->
                            @foreach($itemnhanvien as $item)
                            <option value="{{$item->id}}">{{$item->hoTen}}</option>
                            @endforeach
                    </select>
                </div>



            <div class="text-center" style="margin-top: 5rem;">
                <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                <button type="button" id="check" class="btn btn-primary">Lưu</button>
                <a href="{{route('phieumuon.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
            </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost='/admin/danhmuc/phieumuon';
    $("#check").click(function () {
        var hl = $("#phieumuonForm").valid();
        if (hl) {
            thucHienAjax($("#phieumuonForm"));
        }
    });

    // $("#phieumuonForm").validate({
    //     onfocusout: function (element) {
    //         if ($(element).val() == "") return;
    //         var hl = $(element).valid();
    //         if (hl) {

    //             if ($(element).hasClass('is-invalid'))
    //                 $(element).removeClass("form-control is-invalid");
    //             $(element).addClass('form-control is-valid');
    //         }
    //     }, onkeyup: false,
    //     rules: {
    //         namSinh:{
    //             // min:'1950',
    //             // max: '2020',
    //             required:true
    //         },
    //     },
    //     messages: {
    //         namSinh:{
    //             // min:'Năm sinh quá lâu, chém gió à',
    //             // max: 'Năm sinh lớn hơn hiện tại, chém gió à',
    //             required:'Không được bỏ trống'
    //         },
    //     }, errorPlacement: function (err, elemet) {
        
    //     err.insertAfter(elemet);    
    //     err.addClass('invalid-feedback d-inline text-danger');
    //     elemet.addClass('form-control is-invalid');
    //     $('.focus-input100-1,.focus-input100-2').addClass('hidden');
    // }
    //});
    function thucHienAjax(form) {
        var obj = {
            'ngayMuon': $("#ngayMuon").val(),
            'ngayHenTra': $("#ngayHenTra").val(),
            'ID_DocGia': $("#selectDocGia").children('option:selected').val(),
            'ID_NhanVien': $("#selectNhanVien").children('option:selected').val(),
        
        };
        console.log(obj);
        
        $.ajax({
            type: "post",
            url: urlPost,
            data: obj,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                if (response.yes === true) {

                //    var now = new Date();
                //     $("#ngayMuon").val("");
                //     $("#ngayHenTra").val( now.getTime());
                //     $("#ID_DocGia").val("");
                //     $("#ID_NhanVien").val("");

                    alertify.success('Thêm độc giả thành công');
                }
            }
        });
    }



</script>
@endsection