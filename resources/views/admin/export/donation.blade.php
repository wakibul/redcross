<html>

<body>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>SL No.</th>
                <th>Request ID</th>
                <th>Donation Type</th>
                <th>Name</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Address</th>
                <th>Village / Town</th>
                <th>District</th>
                <th>Pincode</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Blood Group</th>
                <th>Donation Amount</th>
                <th>Pupose of Donation</th>
                <th>Pan no</th>
                
            </tr>
        </thead>
        <tbody>
            
            @forelse($donations as $key => $donation)
          
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$donation->donation_request_id??'NA'}}</td>
                <td>@if($donation->donation_type == 1)
                    Cash
                    @else
                    Blood
                    @endif
                </td>
                <td>{{$donation->name ?? ''}}</td>
                <td>{{$donation->age??'NA'}}</td>
                <td>{{$donation->address??'NA'}}</td>
                <td>{{$donation->village_town??'NA'}}</td>
                <td>{{$donation->district??'NA'}}</td>
                <td>{{$donation->pincode??'NA'}}</td>
                <td>{{$donation->pincode??'NA'}}</td>
                <td>{{$donation->mobile??'NA'}}</td>
                <td>{{$donation->email??'NA'}}</td>
                <td>{{$donation->blood_group??'NA'}}</td>
                <td>{{$donation->donation_amount??'NA'}}</td>
                <td>{{$donation->donation_pupose??'NA'}}
                </td>
                <td>{{$donation->pan_no??'NA'}}
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