@extends('backend.layouts.master')



@section('page-css')

    <link rel="stylesheet" href="{{ asset('common/datatables/css/1.10.20.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('common/datatables/css/2.2.3.responsive.bootstrap4.min.css') }}">

@endsection


@section('content')
<!-- File export table -->
<section id="file-export">
  <div class="row">
    <div class="col-12">
      <div class="card">
         <form id="frm-example" method="get">
        <div class="card-header">
         <div class="row">
           <div class="col-md-6">
             <h4 class="">DISPLAY ALL ORDERS</h4>
           </div>

           <div class="col-md-6">

           

           </div>
         </div>

        </div>
          <div class="card-body card-dashboard table-responsive">
            <div class="table-responsive">
              <div class="card-content">

           <br />

              <table class="table table-bordered table-striped " id="JsDataTable">
                <thead>
                  <tr>
                   
                    <th>Orderer Details</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th>Orderer Details</th>
                    <th>Action</th>
                  </tr>
                </tfoot>

              </table>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- File export table -->


{{-- Modal start here --}}
<div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby  ="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Insert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-3">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6 text-right">
                <p>Orderer Name:</p>
              </div>
              <div class="col-md-6 text-left">
                <p class="name"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-fotter">
        <div class="row">
          <div class="col">
            <input type="button" data-dismiss="modal" name="cancel" value="Close" class="btn btn-primary btn-block">
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
{{-- Product add modal end --}}


@endsection




@section('page-js')

    {{-- DataTable --}}
    <script src="{{ asset('common/datatables/js/1.10.20.jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('common/datatables/js/1.10.20.dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('common/datatables/js/2.2.3.dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('common/datatables/js/2.2.3.responsive.bootstrap4.min.js') }}" type="text/javascript"></script>

    <!-- Modal Show-->
    <script src="{{ asset('app-assets/js/components-modal.min.js') }}" type="text/javascript" ></script>


<script>

$(document).ready(function(){

  // Show data in page
   var table= $('#JsDataTable').DataTable({
    language: {
        processing: '<i class="fa fa-refresh fa-spin fa-3x fa-fw green"></i><span class="sr-only">Loading...</span> '},
    processing: true,
    serverSide: true,
    pagingType: "full_numbers",
    stateSave: true,

    ajax:{
    url: "{{ route('admin.order.index') }}",
    },
      columns:[

       
            {
                data: 'details',
                name: 'details'
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
                "searchable": false
            }
        ],

  });




    // delete data start from  here
    $(document).on('click', '.delete', function(){

    let id = $(this).attr('id');

    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.value) {

        console.log(id)

                $.ajax({
                url: "order/delete/"+id,
                method: 'get',
                success:function(response){
                    //console.log(response);
                    if(response = 'ok'){
                        //Datatable Reload
                        $('#JsDataTable').DataTable().ajax.reload();

                        //Sweet alert
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Your file has been deleted',
                            showConfirmButton: false,
                            timer: 1500
                        })


                    }else{
                        console.log(response);
                    }


                },
                error:function(response){
                    console.log(response);
                }
            });

            }
        })

    });
    //delete end here

    

// Seen by Admin data start from  here

 $(document).on('click', '.admin', function(){
  id = $(this).attr('id');
  $.ajax({
  url:"order/seen/"+id,
   success:function(data)
   {
    // toastr
       Toast.fire({
          icon: 'success',
          title: 'Order Seen Status successfully'
        });
     $('#JsDataTable').DataTable().ajax.reload();
   }
  })
 });
// seen end here


// Paid  data start from  here
 $(document).on('click', '.paid', function(){
  id = $(this).attr('id');
  $.ajax({
  url:"order/paid/"+id,
   success:function(data)
   {
    // toastr
       Toast.fire({
          icon: 'success',
          title: 'Order Paid Status successfully'
        });
     $('#JsDataTable').DataTable().ajax.reload();
   }
  })
 });
// Paid end here




// Complete  data start from  here
 $(document).on('click', '.complete', function(){
  id = $(this).attr('id');
  $.ajax({
  url:"order/complete/"+id,
   success:function(data)
   {
    // toastr
       Toast.fire({
          icon: 'success',
          title: 'Order Complete Status successfully'
        });
     $('#JsDataTable').DataTable().ajax.reload();
   }
  })
 });
// complete end here

// Cancel  data start from  here
    $(document).on('click', '.cancel', function(){

    let id = $(this).attr('id');

    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Cancel it!'
    }).then((result) => {
    if (result.value) {

        console.log(id)

                $.ajax({
                url: "order/cancel/"+id,
                method: 'get',
                success:function(response){
                    //console.log(response);
                    if(response = 'ok'){
                        //Datatable Reload
                        $('#JsDataTable').DataTable().ajax.reload();

                        //Sweet alert
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Order has been Canceled',
                            showConfirmButton: false,
                            timer: 1500
                        })


                    }else{
                        console.log(response);
                    }


                },
                error:function(response){
                    console.log(response);
                }
            });

            }
        })

    });

// cancel end here



//start edit modal from here
$(document).on('click', '.view', function(){
 id = $(this).attr('id');
  $.ajax({
   url:"order/view/"+id,
   dataType:"json",
   success:function(data){

    $('.name').text(data.name);
    $('#description').val(data.description);
    $('#price').val(data.price);
    $('#quantity').val(data.quantity);
    $('#category').val(data.cat_id);
    $('#sub').val(data.sub_id);


    $('.modal-title').text("View  Order Information");
    $('#formModal').modal('show');
   }
  })
 });

// End edit data in modal






});




</script>

 @endsection
