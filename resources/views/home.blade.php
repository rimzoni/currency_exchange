	@extends('template')

@section('content')

<div class="container" ng-app="currencyTransferApp" ng-controller="currencyTransferController">
<div class="row">
	<h1>Welcome to the Currency Transfer Application</h1>
	<p>Send and Receive money!</p>
	<div class="jumbotron">
	<form>
  <div class="form-group row">
		<div class="select-group">
			<label for="exchangeRateSelect">Select exchange currency</label>
			<select class="form-control" ng-model="exchangeCurrency"  ng-options="rate as rate.name for rate in rates" placeholder="Select exchange currency">
				<option>Select exchange currency</option>
				<option ng-repeat='rate in rates' value="<% rate.rate %>"><% rate.name %></option>
			</select>
		<div class="alert alert-warning" ng-hide="exchangeCurrency_error" role="alert"><% errors.exchangeCurrency %></div>
		</div>
		<br/>
    <div class="input-group">
      <div class="input-group-addon">$</div>
			<input type="text" class="form-control" ng-model="sendingAmount" value="<% sendingAmount %>" placeholder="Sending Amount">
    </div>
		<div class="alert alert-warning" ng-hide="sendingAmount_error" role="alert"><% errors.sendingAmount %></div>
		<br/>
		<div class="input-group">
			<div class="input-group-addon"><% exchangeCurrency.name %></div>
			<input type="text" class="form-control" ng-model="receivingAmount" placeholder = "Receiving Amount" >
		</div>
  </div>
	<div class="alert alert-warning" ng-hide="receivingAmount_error" role="alert"><% errors.receivingAmount %></div>
	<br/>
	<div class="row">
	  <div class="col-lg-8">
	    <div class="row">
	  		<p ng-hide="!exchangeCurrency">Your Rate: 1$ = <strong><% exchangeCurrency.name %></strong><% exchangeCurrency.rate %></p>
	    </div>
	  </div>
	  <div class="col-lg-4">
	    <div class="row">
				<p ng-hide="hideSurcharge" ng-model="surcharge" >Transfer fees: $<strong><% surcharge.chargeValue %></strong></p>
	  	</div>
		</div>
	</div>
	<div class="button-group-inline">
	<input type="hidden" name="_token"  ng-model="csrf_token" value="{{{ csrf_token() }}}" />
	<button class="btn btn-info btn-md"  ng-click="calculateRate()">Calculate</button>
  <button type="submit" class="btn btn-success btn-md"  ng-click="purchaseOrder()">Purchase</button>
	</div>
</form>
	<div class="alert alert-success" ng-hide="confirmed" role="alert">You have successfully purchased <strong><% exchangeCurrency.name %></strong> <% orders.purchased_amount %></div>
	<div class="alert alert-danger" ng-hide="removedOrder" role="alert">Order is canceled.</div>
	<div class="loading" data-loading ng-hide="loading"></div>
		<div class="order" ng-hide="confirmOrder">
		<div class="row">
			<div class="col-lg-4">
		    <div class="row">
				</div>
			</div>
		  <div class="col-lg-4">
			    <div class="row">
						<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">Confirm Order</div>
					<!-- List group -->
					<ul class="list-group">
						<li class="list-group-item">Exchanged Currency: <% orders.exchanged_currency %></li>
						<li class="list-group-item">Exchanged Rate: <% orders.exchanged_rate %></li>
						<li class="list-group-item">Paid Amount: <% orders.paid_amount %></li>
						<li class="list-group-item">Purchased Amount: <% orders.purchased_amount %></li>
						<li class="list-group-item">Surcharge Amount: <% orders.surcharge_amount %></li>
						<li class="list-group-item">Surcharge Percentage: <% orders.surcharge_percentage %>%</li>
						<li class="list-group-item">Discount Amount: <% orders.discount_amount %></li>
						<li class="list-group-item">Discount Percentage: <% orders.discount_percentage %>%</li>
						<li class="list-group-item">Status: <%  order.status==1? 'Confirmed' : 'Prepared' %></li>
						<li class="list-group-item"></li>
						<li class="list-group-item alert alert-success" >Total Order Amount: $<% orders.total_amount %></li>
					</ul>
					<div class="panel-body">
					</div>
					<button class="btn btn-info btn-md"  ng-click="confirm()">Confirm Order</button>
					<button class="btn btn-danger btn-md"  ng-click="cancelOrder(orders.id)">Cancel Order</button>
					</div>
				</div>
		  </div>
		  <div class="col-lg-4">
		    <div class="row">
				</div>
			</div>
	</div>
</div>
</div>
</div>
@stop
