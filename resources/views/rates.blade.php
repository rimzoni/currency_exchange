@extends('template')

@section('content')

<div class="container" ng-app="currencyTransferApp" ng-controller="currencyTransferController">
	<div class="row">
		<div class="col-lg-6">
			<div class="row">
				<h3> Rates </h3>
				<button class="btn btn-info btn-md"  ng-click="updateRates()">Update</button>
				<table class="table">
					<thead class="thead-inverse">
						<tr>
							<th>Source name</th>
							<th>Rate name</th>
							<th>Rate Value</th>
							<th>Created</th>
							<th>Updated</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="rate in rates">
						  <td><% rate.source %></td>
							<td><% rate.name %></td>
							<td><% rate.rate %></td>
							<td><% rate.created_at %></td>
							<td><% rate.updated_at %></td>
							<td><span class="giglyphicon giglyphicon-edit"></span></td>
							<td><a><span ng-click="removeExchangeRate($index)" class="glyphicon glyphicon-minus"></span></a></td>
					 </tr>
					</tbody>
				</table>

			</div>
		</div>
		<div class="col-lg-6">
	</div>
</div>
@stop
