@extends('admin.dashboard')

@section('maincontent')
{{-- session --}}
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong></strong>Category updated Successfully.
</div>
@endif
{{-- session --}}
<style>
    .error {
        color: #dc3545;
         font-weight: 700;
         display:block;
         padding: 6px 0;
         font-size: 14px;
    }
</style>

<div class="card">
  <div class="card-header"><b>EDIT CATEGORY PAGE </b>
    <a class="btn btn-danger float-right" href="{{ route('category.index') }}" role="button">cancel</a><br>
  </div>
  <div class="card-body">

  <form action="{{ url('/admin/category/update',[$category->id]) }}" id="formc" method="post" enctype="multipart/form-data">

      {!! csrf_field() !!}
        <label id="error" style="display: none;"></label>
        <label>category Name</label><br>
        <input type="text" value="{{ $category->name }}" name="name" id="product_input_name" class="form-control" oninput="this.value = this.value.replace(/[^A-za-z_\s]/g, '').replace(/(\..*)\./g, '$1');">
        <span style="color: red">@error('name'){{$message}}@enderror</span><br>

        <input type="submit" value="update" class="btn btn-success">
    </form>

  </div>
</div>
@endsection

@push('custom-script')
<script src="{{asset('resources/assets/common/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('resources/assets/common/js/additional-methods.min.js')}}"></script>
<script src="{{asset('resources/assets/admin/plugins/select2/js/select2.min.js')}}." type="text/javascript"></script>
    <script src="{{asset('resources/assets/admin/plugins/bootstrap-select/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('resources/assets/admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js')}}" ></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/3.2.12/jquery.validate.unobtrusive.min.js')}}" ></script>
<script>

    $(document).ready(function(){
        $("#formc").validate({
            ignore: [],
            rules:{
                name:{
                    required:true,
                    maxlength:10,
                    remote: {
                        url: '/admin/category/uniquename',
                        type: "GET",
                        data: {
                            categoryname: function() {
                                return $("#name").val();
                            }
                        },
                    }
                },

            },
            messages:{


            name: {
                required: 'Enter The category Name',
                maxlength:'The Name May Not Be Greater Than 10 Characters.',
                remote: "The Name has already been taken !! ",

            },

            },
        });
    });

</script>

@endpush
