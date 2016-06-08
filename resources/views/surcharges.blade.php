	@extends('template')

@section('content')

<div class="container" ng-app="currencyTransferApp" ng-controller="currencyTransferController">
	  <div class="row">
	    <div class="col-lg-6">
				<div class="row">
					<h3> Surcharges </h3>
					<button class="btn btn-info btn-md"  ng-click="displayNewSurcharge(newSurcharge)" >New</button>
					<table class="table">
					  <thead class="thead-inverse">
					    <tr>
					      <th>Currency</th>
					      <th>Percentage</th>
					      <th>Created</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="surcharge in surcharges">
					      <td><% surcharge.currency %></td>
					      <td><% surcharge.percentage %></td>
					      <td><% surcharge.created_at %></td>
								<td><span class="giglyphicon giglyphicon-edit"></span></td>
								<td><a><span ng-click="removeSurcharge($index)" class="glyphicon glyphicon-minus"></span></a></td>
             </tr>
					  </tbody>
					</table>

				</div>
	    </div>
	    <div class="col-lg-7">
				<div class="row"  ng-hide="newSurcharge">
					<h2>Create surcharge</h2>
					<form>
				  <div class="form-group row">
				    <div class="input-group">
				      <div class="input-group-addon"></div>
							<input type="text" class="form-control" ng-model="surcharge_currency" value="<% surcharge_currency %>" placeholder="Enter surcharge currency">
						</div>
						<div class="alert alert-warning" ng-hide="surcharge_currency_error" role="alert"><% errors.currency %></div>
						<div class="input-group">
							<div class="input-group-addon">%</div>
							<input type="text" class="form-control" ng-model="surcharge_percentage" placeholder = "Enter surcharge percentage" >
						</div>
						<div class="alert alert-warning" ng-hide="surcharge_percentage_error"  role="alert"><% errors.percentage %></div>
				  </div>

					<div class="button-group-inline">
					<input type="hidden" name="_token"  ng-model="csrf_token" value="{{ csrf_token() }}" />
					<button class="btn btn-info btn-md"  ng-click="createSurcharge()">Create Surcharge</button>
				  </div>
				</form>
	    </div>
	  </div>
</div>
@stop
