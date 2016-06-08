	@extends('template')

@section('content')

<div class="container" ng-app="currencyTransferApp" ng-controller="currencyTransferController">
	  <div class="row">
	    <div class="col-lg-6">
				<div class="row">
					<h3> Orders </h3>
					<table class="table">
					  <thead class="thead-inverse">
					    <tr>
					      <th>Currency</th>
					      <th>Rate</th>
					      <th>Purchased Amount</th>
					      <th>Paid Amount</th>
					      <th>Surcharge Amount</th>
					      <th>Surcharge Percentage</th>
					      <th>Discount Amount</th>
					      <th>Discount Percentage</th>
								<th>Status</th>
					      <th>Total Amount</th>
								<th>Created</th>
					      <th>Updated</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="order in orders">
					      <td><% order.exchanged_currency %></td>
					      <td><% order.exchanged_rate %></td>
					      <td><% order.purchased_amount %></td>
					      <td><% order.paid_amount %></td>
					      <td><% order.surcharge_amount %></td>
					      <td><% order.surcharge_amount %>%</td>
					      <td><% order.discount_amount %></td>
					      <td><% order.discount_percentage %></td>
					      <td><% order.status==1? 'Confirmed' : 'Prepared' %></td>
					      <td><% order.total_amount %></td>
					      <td><% order.created_at %></td>
					      <td><% order.updated_at %></td>
							</tr>
					  </tbody>
					</table>

				</div>
	    </div>
</div>
@stop
