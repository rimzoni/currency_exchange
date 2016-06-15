	@extends('template')

@section('content')

<div class="container" ng-app="currencyTransferApp" ng-controller="currencyTransferController">
	  <div class="row">
	    <div class="col-lg-6">
				<div class="row">
					<h3> Discounts </h3>
					<button class="btn btn-info btn-md"  ng-click="displayNewDiscount(newDiscount)" >New</button>
					<table class="table">
					  <thead class="thead-inverse">
					    <tr>
					      <th>Currency</th>
					      <th>Percentage</th>
					      <th>Created</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="discount in discounts">
					      <td><% discount.currency %></td>
					      <td><% discount.percentage %></td>
					      <td><% discount.created_at %></td>
								<td><a><span ng-click="showEditDiscount($index)" class="glyphicon glyphicon-pencil"></span></a></td>
								<td><a><span ng-click="removeDiscount($index)" class="glyphicon glyphicon-minus"></span></a></td>
             </tr>
						 <tr ng-hide="editDiscount">
							 <td><input type="text" class="form-control" ng-model="edit_currency"  ></td>
							 <td><input type="text" class="form-control" ng-model="edit_percentage"  ></td>
							 <td></td>
							 <td><a><span ng-click="saveEditedDiscount(edit_index)" class="glyphicon glyphicon-floppy-save"></span></a></td>
							 <td></td>
							</tr>
					  </tbody>
					</table>

				</div>
	    </div>
	    <div class="col-lg-7">
				<div class="row"  ng-hide="newDiscount">
					<h2>Create discount</h2>
					<form>
				  <div class="form-group row">
				    <div class="input-group">
				      <div class="input-group-addon"></div>
							<input type="text" class="form-control" ng-model="discount_currency" value="<% discount_currency %>" placeholder="Enter discount currency">
				    </div>
						<div class="alert alert-warning" ng-hide="discount_currency_error" role="alert"><% errors.currency %></div>
						<div class="input-group">
				      <div class="input-group-addon">%</div>
							<input type="text" class="form-control" ng-model="discount_percentage" placeholder = "Enter discount percentage" >
						</div>
						<div class="alert alert-warning" ng-hide="discount_percentage_error" role="alert"><% errors.percentage %></div>
				  </div>

					<div class="button-group-inline">
					<input type="hidden" name="_token"  ng-model="csrf_token" value="{{ csrf_token() }}" />
					<button class="btn btn-info btn-md"  ng-click="createDiscount()">Create discount</button>
				  </div>
				</form>
	    </div>
	  </div>
</div>
@stop
