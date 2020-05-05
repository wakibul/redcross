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
                <th>Blood Donation</th>
                <th>Blood Group</th>
                <th>Relief</th>
                <th>Medical Assistance</th>
                <th>Other</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            
            @forelse($helps as $key => $help)
          
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$help->help_request_id??'NA'}}</td>
                <td>{{$help->name ?? ''}}</td>
                <td>{{$help->age??'NA'}}</td>
                <td>{{$help->address??'NA'}}</td>
                <td>{{$help->village_town??'NA'}}</td>
                <td>{{$help->district??'NA'}}</td>
                <td>{{$help->pincode??'NA'}}</td>
                <td>{{$help->pincode??'NA'}}</td>
                <td>{{$help->mobile??'NA'}}</td>
                <td>{{$help->email??'NA'}}</td>
                <td>@if($help->blood_donation == 1)
                    Yes
                    @else
                    NO
                    @endif
                </td>
                <td>{{$help->blood_group??'NA'}}</td>
                <td>@if($help->relief == 1)
                    Yes
                    @else
                    NO
                    @endif
                </td>

                <td>@if($help->medical_assistance == 1)
                    Yes
                    @else
                    NO
                    @endif
                </td>
                <td>@if($help->other == 1)
                    Yes
                    @else
                    NO
                    @endif
                </td>
      
                <td>{{$help->message??'NA'}}</td>
               
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