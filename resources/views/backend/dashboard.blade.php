@extends('backend.master')
@section('dashboard','active show-sub')
@section('content')

<div class="row row-sm">
    <div class="col-sm-6 col-xl-3">
      <div class="card pd-20 bg-primary">
        <div class="d-flex justify-content-between align-items-center mg-b-10">
          <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Today's Sales</h6>
          <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
        </div><!-- card-header -->
        <div class="d-flex align-items-center justify-content-between">
          <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
          <h3 class="mg-b-0 tx-white tx-lato tx-bold">$850</h3>
        </div><!-- card-body -->
        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
          <div>
            <span class="tx-11 tx-white-6">Gross Sales</span>
            <h6 class="tx-white mg-b-0">$2,210</h6>
          </div>
          <div>
            <span class="tx-11 tx-white-6">Tax Return</span>
            <h6 class="tx-white mg-b-0">$320</h6>
          </div>
        </div><!-- -->
      </div><!-- card -->
    </div><!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
      <div class="card pd-20 bg-info">
        <div class="d-flex justify-content-between align-items-center mg-b-10">
          <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Week's Sales</h6>
          <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
        </div><!-- card-header -->
        <div class="d-flex align-items-center justify-content-between">
          <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
          <h3 class="mg-b-0 tx-white tx-lato tx-bold">$4,625</h3>
        </div><!-- card-body -->
        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
          <div>
            <span class="tx-11 tx-white-6">Gross Sales</span>
            <h6 class="tx-white mg-b-0">$2,210</h6>
          </div>
          <div>
            <span class="tx-11 tx-white-6">Tax Return</span>
            <h6 class="tx-white mg-b-0">$320</h6>
          </div>
        </div><!-- -->
      </div><!-- card -->
    </div><!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
      <div class="card pd-20 bg-purple">
        <div class="d-flex justify-content-between align-items-center mg-b-10">
          <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Month's Sales</h6>
          <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
        </div><!-- card-header -->
        <div class="d-flex align-items-center justify-content-between">
          <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
          <h3 class="mg-b-0 tx-white tx-lato tx-bold">$11,908</h3>
        </div><!-- card-body -->
        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
          <div>
            <span class="tx-11 tx-white-6">Gross Sales</span>
            <h6 class="tx-white mg-b-0">$2,210</h6>
          </div>
          <div>
            <span class="tx-11 tx-white-6">Tax Return</span>
            <h6 class="tx-white mg-b-0">$320</h6>
          </div>
        </div><!-- -->
      </div><!-- card -->
    </div><!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
      <div class="card pd-20 bg-sl-primary">
        <div class="d-flex justify-content-between align-items-center mg-b-10">
          <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Year's Sales</h6>
          <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
        </div><!-- card-header -->
        <div class="d-flex align-items-center justify-content-between">
          <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
          <h3 class="mg-b-0 tx-white tx-lato tx-bold">$91,239</h3>
        </div><!-- card-body -->
        <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
          <div>
            <span class="tx-11 tx-white-6">Gross Sales</span>
            <h6 class="tx-white mg-b-0">$2,210</h6>
          </div>
          <div>
            <span class="tx-11 tx-white-6">Tax Return</span>
            <h6 class="tx-white mg-b-0">$320</h6>
          </div>
        </div><!-- -->
      </div><!-- card -->
    </div><!-- col-3 -->
  </div><!-- row -->

  <div class="row row-sm mg-t-20">
    <div class="col-xl-8">
      <div class="card overflow-hidden">
        <div class="card-header bg-transparent pd-y-20 d-sm-flex align-items-center justify-content-between">
          <div class="mg-b-20 mg-sm-b-0">
            <h6 class="card-title mg-b-5 tx-13 tx-uppercase tx-bold tx-spacing-1">Profile Statistics</h6>
            <span class="d-block tx-12">October 23, 2017</span>
          </div>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="#" class="btn btn-secondary tx-12 active">Today</a>
            <a href="#" class="btn btn-secondary tx-12">This Week</a>
            <a href="#" class="btn btn-secondary tx-12">This Month</a>
          </div>
        </div><!-- card-header -->
        <div class="card-body pd-0 bd-color-gray-lighter">
          <div class="row no-gutters tx-center">
            <div class="col-12 col-sm-4 pd-y-20 tx-left">
              <p class="pd-l-20 tx-12 lh-8 mg-b-0">Note: Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula...</p>
            </div><!-- col-4 -->
            <div class="col-6 col-sm-2 pd-y-20">
              <h4 class="tx-inverse tx-lato tx-bold mg-b-5">6,112</h4>
              <p class="tx-11 mg-b-0 tx-uppercase">Views</p>
            </div><!-- col-2 -->
            <div class="col-6 col-sm-2 pd-y-20 bd-l">
              <h4 class="tx-inverse tx-lato tx-bold mg-b-5">102</h4>
              <p class="tx-11 mg-b-0 tx-uppercase">Likes</p>
            </div><!-- col-2 -->
            <div class="col-6 col-sm-2 pd-y-20 bd-l">
              <h4 class="tx-inverse tx-lato tx-bold mg-b-5">343</h4>
              <p class="tx-11 mg-b-0 tx-uppercase">Comments</p>
            </div><!-- col-2 -->
            <div class="col-6 col-sm-2 pd-y-20 bd-l">
              <h4 class="tx-inverse tx-lato tx-bold mg-b-5">960</h4>
              <p class="tx-11 mg-b-0 tx-uppercase">Shares</p>
            </div><!-- col-2 -->
          </div><!-- row -->
        </div><!-- card-body -->
        <div class="card-body pd-0">
          <div id="rickshaw2" class="wd-100p ht-200"></div>
        </div><!-- card-body -->
      </div><!-- card -->

      <div class="card pd-20 pd-sm-25 mg-t-20">
        <h6 class="card-body-title tx-13">Horizontal Bar Chart</h6>
        <p class="mg-b-20 mg-sm-b-30">A bar chart or bar graph is a chart with rectangular bars with lengths proportional to the values that they represent.</p>
        <canvas id="chartBar4" height="300"></canvas>
      </div><!-- card -->

    </div><!-- col-8 -->
    <div class="col-xl-4 mg-t-20 mg-xl-t-0">

      <div class="card pd-20 pd-sm-25">
        <h6 class="card-body-title">Pie Chart</h6>
        {{--  <div id="flotPie2" class="ht-200 ht-sm-250"></div>  --}}
        <canvas id="myChart" width="400" height="400"></canvas>
      </div><!-- card -->

    </div><!-- col-3 -->
  </div><!-- row -->

@endsection
@section('footer_js')
<script src="//cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.js"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Today', 'Yesterday', '7 Days Ago', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [{{ $today }}, {{ $yesterday }}, {{ $seven_days_ago }}, 5, 2, 3],
                backgroundColor: [
                    'green',
                    'red',
                    'blue',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
@endsection
