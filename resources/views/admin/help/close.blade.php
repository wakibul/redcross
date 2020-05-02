@extends('admin.layout.master')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Open Issue
        </h1>
    </div>
<div class="col-md-12">
@include('admin.filter.help')
@include('admin.layout.alert')
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Applied Mobile No</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Applied on</th>
                <th>Closed on</th>
            </tr>
        </thead>
        <tbody>
            @forelse($helps as $key=>$help)
            <tr>
                <td>{{ ($key+1) }}</td>
                
                <td>{{$help->name}}</td>
                <td>{{$help->mobile}}</td>
                <td>{{$help->email ? $help->email : 'Not available'}}</td>
                <td>{{$help->sex}}</td>
                <td>{{date('d-M-Y',strtotime($help->created_at))}}</td>
                <td>{{date('d-M-Y',strtotime($help->closed_at))}}</td>
                <td><a href="javascript:void(0)" class="btn btn-sm btn-primary info" data-id="{{$help->id}}">Info</a>
                <a href="{{route('admin.help.pdf',Crypt::encrypt($help->id))}}" class="btn btn-sm btn-orange" target="_blank">PDF</a>
                <a href="{{route('admin.help.delete',Crypt::encrypt($help->id))}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                    </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No user found</td>
            </tr>
            @endforelse

        </tbody>
    </table>
    {{$helps->links()}}
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
       
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Registration Info</h3>
                </div>
                <div class="card-body">
                    <div id="registration"></div>
                </div>
                </div>
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Status <span id="member_status"></span></h3>
                </div>
                <div class="card-body">
                    <div id="help_trans"></div>
                </div>
                </div>
            </div>
            <div class="col-md-7">
            
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Help Request Info</h3>
                </div>
                <div class="card-body">
                    <div id="help"></div>
                </div>
                </div>

            </div>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection

@section('js')
<script>
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.info').click(function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url:'{{route("admin.help.get_help_info")}}',
        data:'id='+id,
        type:'post',
        dataType:'json',
        success:function(response){
            $('#myModal').modal('show');
            console.log(response);
            if(response.customer.email == null)
                customer_email = "Not Available";
            else
                customer_email = response.customer.email;   
            var user_reg = "<div class='row'><div class='col-md-4'><strong>Name :</strong></div>";
            user_reg += "<div class='col-md-8'>"+response.customer.name+"</div></div>";
            user_reg += "<div class='row'><div class='col-md-4'><strong>Mobile :</strong></div>";
            user_reg += "<div class='col-md-8'>"+response.customer.mobile+"</div></div>";
            user_reg += "<div class='row'><div class='col-md-4'><strong>Email :</strong></div>";
            user_reg += "<div class='col-md-8'>"+customer_email+"</div></div>";
            $('#registration').html(user_reg);
            if(response.voluntary_service == 1)
                voluntary_service = "Yes";
            else
                voluntary_service = "No";

              

                if(response.email == null)
                email = "Not Available";
            else
                email = response.email;

            if(response.blood_donation == 1)
                blood_donation = "Yes";
            else
                blood_donation = "No"; 

            if(response.medical_assistance == 1)
                medical_assistance = "Yes";
            else
                medical_assistance = "No"; 

            if(response.relief == 1)
                relief = "Yes";
            else
                 relief = "No"; 

            if(response.other == 1)
                other = "Yes";
            else
                 other = "No";      

            var member_info = "<div class='row'><div class='col-md-4'><strong>Request Id :</strong></div>";
            member_info += "<div class='col-md-8'><strong>"+response.help_request_id+"</strong></div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Name :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.name+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Mobile :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.mobile+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Email :</strong></div>";
            member_info += "<div class='col-md-8'>"+email+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Age :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.age+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Sex :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.sex+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Address :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.address+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Village / Town :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.village_town+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>District :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.district+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Pincode :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.pincode+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Medical assistance :</strong></div>";
            member_info += "<div class='col-md-8'>"+medical_assistance+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Blood Donation :</strong></div>";
            member_info += "<div class='col-md-8'>"+blood_donation+"</div></div>";
            if(response.blood_donation == 1){
            member_info += "<div class='row'><div class='col-md-4'><strong>Blood Group :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.blood_group+"</div></div>";
            }
            member_info += "<div class='row'><div class='col-md-4'><strong>Relief :</strong></div>";
            member_info += "<div class='col-md-8'>"+relief+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Other :</strong></div>";
            member_info += "<div class='col-md-8'>"+other+"</div></div>";
            if(response.blood_donation == 1){
            member_info += "<div class='row'><div class='col-md-4'><strong>Message :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.message+"</div></div>";
            }
            $('#help').html(member_info);
            if(response.status == 0){
                member_info_status = '<span class="label label-default">On Hold</span>';
                    }
                    else if(response.status == 1){
                        member_info_status = '<span class="label label-primary">On Process</span>';
                    }
                    else if(response.status == 2){
                        member_info_status = '<span class="label label-success">Closed</span>';
                    }
            $('#member_status').html(member_info_status);        
            if(response.help_transactions != null){
                var help_transaction  = "";
                
                $.each(response.help_transactions,function(k,v){
                    if(v.status == 0){
                    status = '<span class="label label-default">On Hold</span>';
                    }
                    else if(v.status == 1){
                        status = '<span class="label label-primary">On Process</span>';
                    }
                    else if(v.status == 2){
                        status = '<span class="label label-success">Closed</span>';
                    }
                     help_transaction  += "<div class='row'><div class='col-md-12' style='color:blue;font-size:12px'><strong>"+new Date(v.created_at)+"</strong></div></div>";
                     help_transaction  += "<div class='row'><div class='col-md-12'><strong>"+status+"</strong></div></div>";
                     help_transaction  += "<div class='row'><div class='col-md-12'  style='font-size:14px'>"+v.remarks+"</div></div>";
                })
                
            }
            else{
                var help_transaction  = "<div class='alert alert-danger'>No Update </div>";
            }
            $('#help_trans').html(help_transaction);
        },
        error:function(response){
            console.log(response);
        }
    })
  })
    
})
</script>
@endsection