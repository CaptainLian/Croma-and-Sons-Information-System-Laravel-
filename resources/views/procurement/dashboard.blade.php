@extends('procurement\main', ['active' => 'dashboard'])

@section('main-content')
	 <!--state overview start-->
      <header class="panel-heading">
        <h1>Procurement Dashboard</h1>
        <br>
        <span class="tools pull-right">
          <a href="javascript:;" class="fa fa-chevron-down"></a>
          <a href="javascript:;" class="fa fa-times"></a>
        </span>
      </header>
      <div class="row state-overview">
        <div class="col-lg-3 col-sm-6">
          <section class="panel">
            <div class="symbol blue">
              <i class="fa fa-user"></i>
            </div>
            <div class="value">
              <h1 class="count">0</h1>
              <p>Pending Purchase Request</p>
            </div>
          </section>
        </div>
        <div class="col-lg-3 col-sm-6">
          <section class="panel">
            <div class="symbol blue">
              <i class="fa fa-user"></i>
            </div>
            <div class="value">
              <h1 class="count">0</h1>
              <p>Pending Purchase Order</p>
            </div>
          </section>
        </div>
      </div>
      <div class="flot-chart">
        <!-- page start-->
        <div class="row">
          <div class="col-lg-6">
            <section class="panel">
              <header class="panel-heading">
                <h3>Reject vs Total Purchases</h3>
              </header>
              <div class="panel-body">
                <div id="graph2" class="chart"></div>
              </div>
            </section>
          </div>
          <div class="col-lg-6">
            <section class="panel">
              <header class="panel-heading">
                <h3>Monthly Procurement</h3>
              </header>
              <div class="panel-body">
                <div id="chart-2" class="chart"></div>
              </div>
            </section>
          </div>
        </div>
        <div class="row"></div>
        <!-- page end-->
      </div>
      <!--state overview end-->
@show


