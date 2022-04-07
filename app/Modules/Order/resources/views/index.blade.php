@extends('admin.dashboard')

@section('maincontent')

<div class="card">
    <div class="card-header">
        <h3 class="card-title"> </h3>
<h3 class="card-title">order</h3>
{{-- <a class="btn btn-danger float-right" href="{{ route('product.showtrash') }}" role="button">Trash</a>
      <a class="btn btn-success float-right" href="{{ route('product.add') }}" role="button">Add</a> --}}

</div>

<div class="card-body">
    <div>


    </div>
    <!-- /.card-header -->
<table id="myTable" class="display table table-bordered table-striped">
    <thead>
        <tr>
        <tr>
        <tr>
         <th>id</th>
         <th >user name</th>
        <th >total price</th>
         <th>payment method</th>
        <th>order date</th>
        <th>status</th>
        <th>action</th>




        </tr>
    </thead>
    <tbody>
      @foreach ($order  as $col)
      <tr>
        <td>{{$col->Id}}</td>

        <td>{{$col->user->name}}</td>

        <td>{{$col->total_price}}</td>
        <td>cash on delivary</td>
        <td>{{$col->created_at}}</td>
        <td>{{$col->order_status}}</td>

        <td>
            <div style="text-align: center;">
                <a href="{{ url('/admin/order/edit',[$col->Id]) }}" class="edit"><i class="fas fa-pencil-alt"></i></a>
                &nbsp;
                <a href="{{ url('/admin/order/invoice',[$col->Id]) }}">
                <i class="fas fa-eye"></i></a>
            </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
   @endsection

   @push('custom-script')
   <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables/jquery.jquery.dataTables.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
   <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
   <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
   <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
   <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
   <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
   <script>
    $(document).ready(function () {
            $('.card-body #myTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "responsive": true,
      "autoWidth": true,
    });






    });
</script>


   @endpush

</body>
</html>


