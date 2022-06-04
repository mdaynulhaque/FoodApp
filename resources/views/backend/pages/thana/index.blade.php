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
             <h4 class="">DISPLAY ALL THANA</h4>
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

              <table class="table table-bordered table-striped  text-center" id="JsDataTable">
                <thead>
                  <tr>
                   
                    <th>District Name</th>
                    <th>Thana Name</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                     <th>District Name</th>
                    <th>Thana Name</th>
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
 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thana Insert</h5>
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
           	 <div class="col">
                <div class="form-group">
                    <label>District Name</label>
                    <select class="form-control form-control-sm" name="district_id" 
                        required="required" id="district_id">
                        <option>Select District</option>
                        @foreach($districts as $district)
                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                </div>
             </div>
          </div>
           <div class="row">
             <div class="col">
                <div class="form-group">
                    <label>Thana Name</label>
                    <input type="text" class="form-control form-control-sm" name="name" placeholder="Enter Thana Name"
                        required="required" id="name">
                </div>
             </div>
          </div>
           

        </div>
        <div class="modal-fotter">
         <div class="row">
           <div class="col-md-9">
              <div class="form-group">
              <input type="hidden" name="action" id="action"/>
              <input type="hidden" name="hidden_id" id="hidden_id" />
              <input type="submit" name="action_button" id="action_button" class="btn btn-primary btn-block ml-3 " value="Add" />
             </div>
           </div>
           <div class="col-md-3">
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
    url: "{{ route('admin.thana.index') }}",
    },
      columns:[

            {
                data: 'district',
                name: 'district'
            },
            {
                data: 'name',
                name: 'name'
            },
           

            {
                data: 'action',
                name: 'action',
                orderable: false,
                "searchable": false
            }
        ],

  });


// insert button id here
$('#create_record').click(function(){


    $('#sample_form')[0].reset();
    $('#form_result').html("");
    $('.modal-title').text("Add New Thana");

    $('#action_button').val("Add");
    $('#action').val("Add");
    $('#formModal').modal('show');
 });
// end  button id here



        // insert data into database by ajax id

        $('#sample_form').on('submit', function(event){
        event.preventDefault();
        var action='';
        if($('#action').val() == 'Add')
        {
        	action="thana/store";
        }
         if($('#action').val() == "Edit")

  		{
  			action="thana/update";
  		}
        $.ajax({
            url:action,
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success:function(data)
            {
                var html = '';
                if(data.errors)
                {
                    console.log('errrror: '+ data.errors);

                    html = '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<li class="text-light">' + data.errors[count] + '</li>';
                    }
                    html += '</div>';

                    $('#form_result').html(html);
                }
                if(data.success)
                {
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                        });

                    $('#formModal').modal('hide');
                    $('#sample_form')[0].reset();
                    $('#JsDataTable').DataTable().ajax.reload();
                    
                }



            }
        })



 });


//  data end store update  from here
 













//start edit modal from here
$(document).on('click', '.edit', function(){
 id = $(this).attr('id');
  $.ajax({
   url:"thana/edit/"+id,
   dataType:"json",
   success:function(data){

    $('#updateId').val(data.id);
    $('#name').val(data.name);
    $('#district_id').val(data.district_id);
    


    $('#hidden_id').val(data.id);
    $('.modal-title').text("Edit New Record");
    $('#action_button').val("Edit");
    $('#action').val("Edit");
    $('#formModal').modal('show');
   }
  })
 });

// End edit data in modal




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
                url: "thana/delete/"+id,
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









});




</script>

 @endsection
