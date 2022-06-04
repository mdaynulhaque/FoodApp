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
             <h4 class="">DISPLAY ALL RESTUARANT </h4>
           </div>

           <div class="col-md-6">

            <button type="button" name="create_record" id="create_record" class="btn gradient-nepal white big-shadow float-right"><i class="fa fa-plus">Add </i></button>

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
                    <th>Restuarant Name</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th>Restuarant Name</th>
                    <th>Address</th>
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
<div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog  modal-xl">
  <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Product Insert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body p-3">
         <span id="form_result"></span>
         <form  id="sample_form" class="form-horizontal" method="post" enctype="multipart/form-data">
          @csrf

          <input type="hidden" name="updateId" id="updateId">

           <div class="row">
           	 <div class="col-md-4">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control form-control-sm" name="title" placeholder="Enter Product Title"
                        required="required" id="title">
                </div>
             </div>
             <div class="col-md-4">
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control form-control-sm" id="price"
                        placeholder="Enter Product Price" required="required">
                    <span id="error_value"></span>
                </div>
             </div>
             <div class="col-md-4">
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control form-control-sm" id="quantity"
                        placeholder="Enter Product Quantity " required="required">
                    <span id="error_value"></span>
                </div>
             </div>          
            </div>
            <div class="row mb-2">
                <div class="form-group col-md-6">
                    <label >Product Details </label>
                    <textarea  class="form-control form-control-sm" placeholder="Enter Car Details" name="description" id="description" rows="5"></textarea>
                </div>
                <div class="col-md-6">
                    <div class="row mt-3"> 
                    	<div class="col-md-12">
                            <label>Product SubCategory</label>
                            <select class="form-control  form-control-sm" id="sub" name="sub" required="">
                              <option value="">Select One</option>
                            	
                            </select>
                        </div>

                      
                    </div>

                </div>
            </div>

                    

                    

        <div class="row">
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-md-3 label-control">1st Image</label>
                    <div class="col-md-9">
                        <input name="image" id="image" type="file" class="file"
                            onchange="document.getElementById('preview1').src = window.URL.createObjectURL(this.files[0])"
                             />
                        <p class="text-danger">Resolution 1280*800 pixels</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-md-3 label-control">2nd Image</label>
                    <div class="col-md-9">
                        <input name="image2" id="image2" type="file" class="file"
                            onchange="document.getElementById('preview2').src = window.URL.createObjectURL(this.files[0])"
                             />
                        <p class="text-danger">Resolution 1280*800 pixels</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-md-3 label-control">3rd Image</label>

                    <div class="col-md-9">
                        <input name="image3" id="image3" type="file" class="file"
                            onchange="document.getElementById('preview3').src = window.URL.createObjectURL(this.files[0])"
                             />
                        <p class="text-danger">Resolution 1280*800 pixels</p>
                    </div>
                </div>
            </div>
        </div>

       <div class="row">
            <div class="col-md-4 carImgPreview">
                <img id="preview1" alt="Image Not Selected" class="rounded mx-auto d-block" width="200" height="100" />
            </div>
            <div class="col-md-4 carImgPreview">
                <img id="preview2" alt="Image Not Selected" class="rounded mx-auto d-block" width="200" height="100" />
            </div>
            <div class="col-md-4 carImgPreview">
                <img id="preview3" alt="Image Not Selected" class="rounded mx-auto d-block" width="200" height="100" />
            </div>
        </div>

        </div>
        <div class="modal-fotter">
         <div class="row">
           <div class="col-md-10">
              <div class="form-group">
              <input type="hidden" name="action" id="action"/>
              <input type="hidden" name="hidden_id" id="hidden_id" />
              <input type="submit" name="action_button" id="action_button" class="btn btn-primary btn-block ml-3 " value="Add" />
             </div>
           </div>
           <div class="col-md-2">
             <input type="button" data-dismiss="modal" name="cancel" value="Close" class="btn btn-warning">
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
  
$('#category').change(function(){
  var category=$('#category').val();

  var opt=  $('#sub').html('');

  $.get("http://localhost/ecomarce/admin/product/subcategory/"+category,function(data){

    var data=JSON.parse(data);
    data.forEach(function(da){
        opt+='<option value="'+da.id+'">'+da.name+'</option>';

    });

     $('#sub').html(opt)

  });

});

</script>

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
    url: "{{ route('admin.restuarant') }}",
    },
      columns:[

            {
                data: 'name',
                name: 'name',
                orderable: false,
                "searchable": false
            },
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
                url: "restuarant/delete/"+id,
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












// Block data start from  here

 $(document).on('click', '.status', function(){
  id = $(this).attr('id');
  $.ajax({
  url:"restuarant/block/"+id,
   success:function(data)
   {
    // toastr
       Toast.fire({
          icon: 'success',
          title: 'User Status Change successfully'
        });

     $('#confirmModal1').modal('hide');
     $('#JsDataTable').DataTable().ajax.reload();
   }
  })
 });
// Block end here




});




</script>

 @endsection
