	@extends('template')

@section('content')

<div class="container" ng-app="currencyTransferApp" ng-controller="currencyTransferController">
	  <div class="row">
	    <div class="col-lg-6">
				<div class="row">
					<h3> Emails </h3>
					<button class="btn btn-info btn-md"  ng-click="displayNewEmail(newEmail)" >New</button>
					<table class="table">
					  <thead class="thead-inverse">
					    <tr>
					      <th>Currency</th>
					      <th>From</th>
					      <th>To</th>
								<th>Subject</th>
								<th>Template</th>
					      <th>Created</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="email in emails">
					      <td><% email.currency %></td>
					      <td><% email.from %></td>
					      <td><% email.to %></td>
					      <td><% email.subject %></td>
					      <td><% email.template %></td>
					      <td><% email.created_at %></td>
								<!-- <td><span class="giglyphicon giglyphicon-edit"></span></td> -->
								<td><a><span ng-click="removeEmail($index)" class="glyphicon glyphicon-minus"></span></a></td>
             </tr>
					  </tbody>
					</table>

				</div>
	    </div>
	    <div class="col-lg-7">
				<div class="row"  ng-hide="newEmail">
					<h2>Create email</h2>
					<form>
				  <div class="form-group row">
				    <div class="input-group">
				      <div class="input-group-addon"></div>
							<input type="text" class="form-control" ng-model="email_currency" value="<% email_currency %>" placeholder="Enter email currency">
				    </div>
						<div class="alert alert-warning" ng-hide="email_currency_error" role="alert"><% errors.currency %></div>
						<div class="input-group">
				      <div class="input-group-addon"></div>
							<input type="email" class="form-control" ng-model="email_from" placeholder = "Enter From field" >
						</div>
						<div class="alert alert-warning" ng-hide="email_from_error" role="alert"><% errors.from %></div>
						<div class="input-group">
				      <div class="input-group-addon"></div>
							<input type="email" class="form-control" ng-model="email_to" placeholder = "Enter To field" >
						</div>
						<div class="alert alert-warning" ng-hide="email_to_error" role="alert"><% errors.to %></div>
						<div class="input-group">
				      <div class="input-group-addon"></div>
							<input type="text" class="form-control" ng-model="email_subject" placeholder = "Enter Subject field" >
						</div>
						<div class="alert alert-warning" ng-hide="email_subject_error" role="alert"><% errors.subject %></div>
						<div class="input-group">
				      <div class="input-group-addon"></div>
							<input type="text" class="form-control" ng-model="email_template" placeholder = "Enter template location" >
						</div>
						<div class="alert alert-warning" ng-hide="email_template_error" role="alert"><% errors.template %></div>
				  </div>

					<div class="button-group-inline">
					<input type="hidden" name="_token"  ng-model="csrf_token" value="{{ csrf_token() }}" />
					<button class="btn btn-info btn-md"  ng-click="createEmail()">Create email</button>
				  </div>
				</form>
	    </div>
	  </div>
</div>
@stop
