<html>

<body>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>SL No.</th>
                <th>Request ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Address</th>
                <th>Village / Town</th>
                <th>District</th>
                <th>Pincode</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Voluntary Service</th>
                <th>Package</th>
            </tr>
        </thead>
        <tbody>
            
            @forelse($members as $key => $member)
          
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$member->member_request_id??'NA'}}</td>
                <td>{{$member->name ?? ''}}</td>
                <td>{{$member->age??'NA'}}</td>
                <td>{{$member->address??'NA'}}</td>
                <td>{{$member->village_town??'NA'}}</td>
                <td>{{$member->district??'NA'}}</td>
                <td>{{$member->pincode??'NA'}}</td>
                <td>{{$member->pincode??'NA'}}</td>
                <td>{{$member->mobile??'NA'}}</td>
                <td>{{$member->email??'NA'}}</td>
                <td>@if($member->voluntary_service == 1)
                    Yes
                    @else
                    NO
                    @endif
                </td>
               
                <td>@if(isset($member->memberPackage))
                    {{$member->memberPackage->name}}
                    @else
                    N/A
                    @endif
                </td>
               
            </tr>
           
            @empty
            <tr>
                <td colspan="8">No Data</td>
            </tr>
            @endforelse

        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
</body>

</html>