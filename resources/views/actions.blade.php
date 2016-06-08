	@extends('template')

@section('content')

<div class="container" ng-app="currencyTransferApp" ng-controller="currencyTransferController">
	  <div class="row">
	    <div class="col-lg-6">
				<div class="row">
					<h3> Actions </h3>
					<button class="btn btn-info btn-md"  ng-click="displayNewAction(newAction)" >New</button>
					<table class="table">
					  <thead class="thead-inverse">
					    <tr>
					      <th>Currency</th>
					      <th>Has Action</th>
					      <th>Action</th>
					      <th>Created</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="action in actions">
					      <td><% action.currency %></td>
					      <td><% action.has_action %></td>
					      <td><% action.action %></td>
					      <td><% action.created_at %></td>
								<!-- <td><span class="giglyphicon giglyphicon-edit"></span></td> -->
								<td><a><span ng-click="removeAction($index)" class="glyphicon glyphicon-minus"></span></a></td>
             </tr>
					  </tbody>
					</table>

				</div>
	    </div>
	    <div class="col-lg-7">
				<div class="row"  ng-hide="newAction">
					<h2>Create action</h2>
					<form>
				  <div class="form-group row">
				    <div class="input-group">
				      <div class="input-group-addon"></div>
							<input type="text" class="form-control" ng-model="action_currency" value="<% action_currency %>" placeholder="Enter action currency">
				    </div>
						<div class="alert alert-warning" ng-hide="action_currency_error" role="alert"><% errors.currency %></div>
						<div class="input-group">
				      <div class="input-group-addon"></div>
							<input type="text" class="form-control" ng-model="action_has_action" placeholder = "Enter true or false for has action" >
						</div>
						<div class="alert alert-warning" ng-hide="action_has_action_error" role="alert"><% errors.has_action %></div>
						<div class="input-group">
				      <div class="input-group-addon"></div>
							<input type="text" class="form-control" ng-model="action_action" placeholder = "Enter action for currency" >
						</div>
						<div class="alert alert-warning" ng-hide="action_action_error" role="alert"><% errors.action %></div>
				  </div>

					<div class="button-group-inline">
					<input type="hidden" name="_token"  ng-model="csrf_token" value="{{ csrf_token() }}" />
					<button class="btn btn-info btn-md"  ng-click="createAction()">Create Action</button>
				  </div>
				</form>
	    </div>
	  </div>
</div>
@stop
