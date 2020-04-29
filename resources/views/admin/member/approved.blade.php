@extends('admin.layout.master')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Approved members
        </h1>
    </div>
<div class="col-md-12">
@include('admin.filter.member')
@include('admin.layout.alert')
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Applied Mobile No</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Member package</th>
                <th>Applied on</th>
                <th>Approved on</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $key=>$member)
            <tr>
                <td>{{ ($key+1) }}</td>
                
                <td>{{$member->name}}</td>
                <td>{{$member->mobile}}</td>
                <td>{{$member->email ? $member->email : 'Not available'}}</td>
                <td>{{$member->sex}}</td>
                <td>{{$member->memberPackage->name}}</td>
                <td>{{date('d-M-Y',strtotime($member->created_at))}}</td>
                <td>{{date('d-M-Y',strtotime($member->approve_at))}}</td>
                <td><a href="javascript::void(0)" class="btn btn-sm btn-primary info" data-id="{{$member->id}}">Info</a>
                <a href="{{route('admin.cancel',Crypt::encrypt($member->id))}}" class="btn btn-sm btn-success" onclick="return confirm('Are you sure to cancel?')">Cancel</a>
                <a href="{{route('admin.delete',Crypt::encrypt($member->id))}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                    </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No user found</td>
            </tr>
            @endforelse

        </tbody>
    </table>
    {{$members->links()}}
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
            </div>
            <div class="col-md-7">
            
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Member Request Info</h3>
                </div>
                <div class="card-body">
                    <div id="member"></div>
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
        url:'{{route("admin.get_member_info")}}',
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
            var member_info = "<div class='row'><div class='col-md-4'><strong>Request Id :</strong></div>";
            member_info += "<div class='col-md-8'><strong>"+response.member_request_id+"</strong></div></div>";
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
            member_info += "<div class='row'><div class='col-md-4'><strong>voluntary_service :</strong></div>";
            member_info += "<div class='col-md-8'>"+voluntary_service+"</div></div>";
            member_info += "<div class='row'><div class='col-md-4'><strong>Member Package :</strong></div>";
            member_info += "<div class='col-md-8'>"+response.member_package.name+"</div></div>";
            $('#member').html(member_info);
        },
        error:function(response){
            
        }
    })
  })
    
})
</script>
@endsection