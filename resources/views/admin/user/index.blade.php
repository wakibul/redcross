@extends('admin.layout.master')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Users
        </h1>
    </div>
<div class="col-md-5">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Is Member</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $key=>$customer)
            <tr>
                <td>{{ ($key+1) }}</td>
                <td>{{$customer->name}}</td>
                <td>{{$customer->mobile}}</td>
                <td>{{$customer->email ? $customer->email : 'Not available'}}</td>
                <td>{{$customer->gender}}</td>
                <td>
                @if($customer->is_member == 1)
                <span class="label label-success">Yes</span>
                @else
                <span class="label label-danger">No</span>
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
    <span class="pull-right"> {{ $customers->links()}}</span>
</div>
@endsection