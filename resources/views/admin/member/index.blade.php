@extends('admin.layout.master')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Users
        </h1>
    </div>
<div class="col-md-12">
@include('admin.filter.user')
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Is Member</th>
                <th>Member Request</th>
                <th>Help Request</th>
                <th>Donation</th>
                <th>Package</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $key=>$member)
            <tr>
                <td>{{ ($key+1) }}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->mobile}}</td>
                <td>{{$user->email ? $user->email : 'Not available'}}</td>
                <td>{{$user->gender}}</td>
                <td>
                @if($user->is_member == 1)
                <span class="label label-success">Yes</span>
                @else
                <span class="label label-danger">No</span>
                @endif
                </td>
                <td>{{getCount("App\Models\Member",$user->id)}}</td>
                <td>{{getCount("App\Models\Help",$user->id)}}</td>
                <td>{{getCount("App\Models\Donation",$user->id)}}</td>
                <td>
                @if(isset($user->memberPackage))
                {{$user->memberPackage->name ? $user->memberPackage->name : "N/A"}}
                @else
                N/A
                @endif
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
@endsection