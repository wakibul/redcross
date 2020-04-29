@extends('admin.layout.master')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Dashboard
        </h1>
    </div>

    <div class="row row-cards">
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    
                    <div class="h1 m-0">{{getTotalUsers("App\Customer")}}</div>
                    <div class="text-muted mb-4">Total Users</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    
                    <div class="h1 m-0">{{getTotalUsers("App\Models\Member")}}</div>
                    <div class="text-muted mb-4">Total Members</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    
                    <div class="h1 m-0">{{getTotal("App\Models\Help")}}</div>
                    <div class="text-muted mb-4">Total Help Request</div>
                  </div>
                </div>
              </div>
              <div class="col-6 col-sm-4 col-lg-2">
                <div class="card">
                  <div class="card-body p-3 text-center">
                    
                    <div class="h1 m-0">{{getTotal("App\Models\Donation")}}</div>
                    <div class="text-muted mb-4">Total Donation</div>
                  </div>
                </div>
              </div>
            
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Month wise statistics</h3>
                  </div>
                  <div id="columnchart_material" style="height: 500px; padding:10px"></div>
                </div>
                
              </div>
            

            </div>

</div>
@endsection

@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Member', 'Help', 'Donation'],
          ['Jan', {{getCountDashboardGraph("App\Models\Member",date('Y'),"01")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"01")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"01")}}],
          ['Feb', {{getCountDashboardGraph("App\Models\Member",date('Y'),"02")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"02")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"02")}}],
          ['march', {{getCountDashboardGraph("App\Models\Member",date('Y'),"03")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"03")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"03")}}],
          ['April', {{getCountDashboardGraph("App\Models\Member",date('Y'),"04")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"04")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"04")}}],
          ['May', {{getCountDashboardGraph("App\Models\Member",date('Y'),"05")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"05")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"05")}}],
          ['June', {{getCountDashboardGraph("App\Models\Member",date('Y'),"06")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"06")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"06")}}],
          ['July', {{getCountDashboardGraph("App\Models\Member",date('Y'),"07")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"07")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"07")}}],
          ['August', {{getCountDashboardGraph("App\Models\Member",date('Y'),"08")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"08")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"08")}}],
          ['September', {{getCountDashboardGraph("App\Models\Member",date('Y'),"09")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"09")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"09")}}],
          ['October', {{getCountDashboardGraph("App\Models\Member",date('Y'),"10")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"10")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"10")}}],
          ['November', {{getCountDashboardGraph("App\Models\Member",date('Y'),"11")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"11")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"11")}}],
          ['December', {{getCountDashboardGraph("App\Models\Member",date('Y'),"12")}}, {{getCountDashboardGraph("App\Models\Help",date('Y'),"12")}}, {{getCountDashboardGraph("App\Models\Donation",date('Y'),"12")}}]
        ]);

        var options = {
          chart: {
            title: 'Total Request',
            subtitle: 'Member, Help, and Donation: <?php echo date('Y');?>',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

@endsection