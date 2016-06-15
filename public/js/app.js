var app = angular.module('currencyTransferApp',[], function($interpolateProvider) {
			$interpolateProvider.startSymbol('<%');
			$interpolateProvider.endSymbol('%>');
		});

app.controller('currencyTransferController', function($scope, $http,$timeout) {

	$scope.apiPath ='/api/v1/';
	$scope.rates = [];
	$scope.loading = false;

	$scope.init = function() {
		$scope.loading = true;

		$scope.hideValuesInit();

		//get rates
		$http.get($scope.apiPath + 'rates').
		success(function(data, status, headers, config) {
			$scope.exchangeCurrency = '';
			$scope.rates = data;
			$scope.loading = false;
		});

		//get surcharges
		$http.get($scope.apiPath + 'surcharges').
		success(function(data, status, headers, config) {
			$scope.surcharges = data;
			$scope.loading = false;
		});

		//get actions
		$http.get($scope.apiPath + 'actions').
		success(function(data, status, headers, config) {
			$scope.actions = data;
			$scope.loading = false;
		});

		//get orders
		$http.get($scope.apiPath + 'orders').
		success(function(data, status, headers, config) {
			$scope.orders = data;
			$scope.loading = false;
		});

		//get emails
		$http.get($scope.apiPath + 'emails').
		success(function(data, status, headers, config) {
			$scope.emails = data;
			$scope.loading = false;
		});

		//get discounts
		$http.get($scope.apiPath + 'discounts').
		success(function(data, status, headers, config) {
			$scope.discounts = data;
			$scope.loading = false;
		});
	}

	$scope.hideValuesInit = function(){
		$scope.newSurcharge = true;
		$scope.newAction = true;
		$scope.hideSurcharge = true;
		$scope.newDiscount = true;
		$scope.newEmail = true;
		$scope.confirmOrder = true;
		$scope.surcharge_percentage_error = true;
		$scope.surcharge_currency_error = true;
		$scope.action_currency_error = true;
		$scope.action_has_action_error = true;
		$scope.action_action_error = true;
		$scope.discount_currency_error = true;
		$scope.discount_percentage_error = true;
		$scope.email_to_error = true;
		$scope.email_currency_error = true;
		$scope.email_from_error = true;
		$scope.email_subject_error = true;
		$scope.email_template_error = true;
		$scope.sendingAmount_error = true;
		$scope.surchargeAmount_error = true;
		$scope.exchangeCurrency_error = true;
		$scope.receivingAmount_error = true;
		$scope.sendingAmount_error = true;
		$scope.confirmed = true;
		$scope.removedOrder= true;
		$scope.editEmail = true;
		$scope.editAction = true;
		$scope.editSurcharge = true;
		$scope.editDiscount = true;
	};
	//calculations
	$scope.calculateTotalAmount = function (){
		var sendingAmount = $scope.sendingAmount;
		var surchargeAmount = $scope.surcharge.chargeValue;

		$http.get($scope.apiPath + 'calculations/calculateTotalAmount', {
			params:{
							sendingAmount:sendingAmount,
							surchargeAmount:surchargeAmount
		}}).
		//get changed field and calculate based on that info
		success(function(data, status, headers, config) {
			$scope.total_amount = data;
			$scope.sendingAmount_error = true;
			$scope.surchargeAmount_error = true;
			$scope.loading = false;
		}).error(function(data, status, headers, config) {
			$scope.errors = data;

			if($scope.errors.sendingAmount!=null)
				$scope.sendingAmount_error = false;
			else
				$scope.sendingAmount_error = true;
			if($scope.errors.surchargeAmount != null)
				$scope.surchargeAmount_error = false;
			else
				$scope.surchargeAmount_error = true;

			$scope.loading = false;
		});
	};

	$scope.sendingAmountCache = '';

	$scope.calculateRate = function() {
		//fix for changing receivingAmount when sendingAmount is not empty
		var sendingAmount
		if($scope.sendingAmountCache==$scope.sendingAmount)
			 sendingAmount = '';
		else
			sendingAmount=$scope.sendingAmount;

		var receivingAmount = $scope.receivingAmount;
		var exchangeCurrencyName = $scope.exchangeCurrency.name;
		var exhcangeCurrencyValue = $scope.exchangeCurrency.rate;
		$scope.loading = true;
		$http.get($scope.apiPath + 'calculations/calculateRate', {
			params:{
			 				exchangeCurrency: exchangeCurrencyName,
			 				sendingAmount:sendingAmount,
							receivingAmount:receivingAmount,
							exchangeValue : exhcangeCurrencyValue
		}}).
		//get changed field and calculate based on that info
		success(function(data, status, headers, config) {
			if(data.method == "PAY"){
				$scope.receivingAmount = data.value;
			}else if (data.method =="PURCHASE") {
				$scope.sendingAmount = data.value;
				sendingAmount = data.value;
			}
			$scope.exchangeCurrency_error = true;
			$scope.receivingAmount_error = true;
			$scope.sendingAmount_error = true;
			$scope.sendingAmountCache=sendingAmount;
			$scope.getSurcharge(exchangeCurrencyName,sendingAmount);

			$scope.loading = false;
		}).error(function(data, status, headers, config) {
			$scope.errors = data;

			if($scope.errors.exchangeCurrency!=null)
				$scope.exchangeCurrency_error = false;
			else
				$scope.exchangeCurrency_error = true;
			if($scope.errors.sendingAmount != null)
				$scope.sendingAmount_error = false;
			else
				$scope.sendingAmount_error = true;
			if($scope.errors.receivingAmount !=null)
				$scope.receivingAmount_error = false;
			else
				$scope.receivingAmount_error = true;
			if($scope.errors.exchangeValue !=null)
				$scope.exchangedCurrency_error = false;
			else
				$scope.exchangedCurrency_error = true;

			$scope.loading = false;
		});
	};
	//action
	//create new action
	$scope.createAction = function() {
		$scope.loading = true;

		var has_action = $scope.action_has_action;
		if(has_action!=null)
			has_action = JSON.parse(has_action);

		$http.post($scope.apiPath + 'actions', {
			currency: $scope.action_currency,
			has_action: has_action,
			action: $scope.action_action,
			csrf_token : $scope.csrf_token
		}).success(function(data, status, headers, config) {
			$scope.action = data;
			$scope.action_currency ='';
			$scope.action_has_action ='';
			$scope.action_action='';
			$scope.newAction = true;
			$scope.action_currency_error = true;
			$scope.action_has_action_error = true;
			$scope.action_action_error = true;
			$scope.actions.push(data);
			$scope.loading = false;
		}).error(function(data, status, headers, config) {
			$scope.errors = data;

			if($scope.errors.currency!=null)
				$scope.action_currency_error = false;
			else
				$scope.action_currency_error = true;
			if($scope.errors.has_action != null)
				$scope.action_has_action_error = false;
			else
				$scope.action_has_action_error = true;
			if($scope.errors.action !=null)
				$scope.action_action_error = false;
			else
				$scope.action_action_error = true;

			$scope.loading = false;
		});
	};

	//remove action
	$scope.removeAction = function(index) {
		$scope.loading = true;

		var action = $scope.actions[index];

		$http.delete($scope.apiPath + 'actions/' + action.id)
			.success(function() {
				$scope.actions.splice(index, 1);
				$scope.loading = false;
			});;
	};

	//display edit action
	$scope.showEditAction = function(index) {
		$scope.loading = true;
		$scope.editAction= false;

		var action = $scope.actions[index];

		$scope.edit_currency = action.currency;
		$scope.edit_has_action = action.has_action==1?true:false ;
		$scope.edit_action = action.action;
		$scope.edit_index = index;

	};

	//edit action
	$scope.saveEditedAction = function(index) {
		$scope.loading = true;
		var action = $scope.actions[index];


		$http.put($scope.apiPath + 'actions/' + action.id,{
			currency: $scope.edit_currency,
			has_action: JSON.parse($scope.edit_has_action),
			action: $scope.edit_action
		})
			.success(function(data, status, headers, config) {
				$scope.actions[index] = data;
				$scope.editAction = true;
				$scope.loading = false;
			});;
	};

	//email
	//create new email
	$scope.createEmail = function() {
		$scope.loading = true;

		$http.post($scope.apiPath + 'emails', {
			currency: $scope.email_currency,
			from: $scope.email_from,
			to: $scope.email_to,
			subject: $scope.email_subject,
			template: $scope.email_template,
			csrf_token : $scope.csrf_token
		}).success(function(data, status, headers, config) {
			$scope.email = data;
			$scope.email_currency ='';
			$scope.email_from ='';
			$scope.email_to ='';
			$scope.email_subject='';
			$scope.email_template='';
			$scope.newEmail = true;
			$scope.email_to_error = true;
			$scope.email_currency_error = true;
			$scope.email_from_error = true;
			$scope.email_subject_error = true;
			$scope.email_template_error = true;
			$scope.emails.push(data);
			$scope.loading = false;
		}).error(function(data, status, headers, config) {
			$scope.errors = data;

			if($scope.errors.currency!=null)
				$scope.email_currency_error = false;
			else
				$scope.email_currency_error = true;
			if($scope.errors.from != null)
				$scope.email_from_error = false;
			else
				$scope.email_from_error = true;
			if($scope.errors.to !=null)
				$scope.email_to_error = false;
			else
				$scope.email_to_error = true;
			if($scope.errors.subject !=null)
				$scope.email_subject_error = false;
			else
				$scope.email_subject_error = true;
			if($scope.errors.template !=null)
				$scope.email_template_error = false;
			else
				$scope.email_template_error = true;

			$scope.loading = false;
		});
	};

	//remove email
	$scope.removeEmail = function(index) {
		$scope.loading = true;

		var email = $scope.emails[index];

		$http.delete($scope.apiPath + 'emails/' + email.id)
			.success(function() {
				$scope.emails.splice(index, 1);
				$scope.loading = false;
			});;
	};

	//display edit email
	$scope.showEditEmail = function(index) {
		$scope.loading = true;
		$scope.editEmail = false;

		var email = $scope.emails[index];

		$scope.edit_email_currency = email.currency;
		$scope.edit_email_from = email.from;
		$scope.edit_email_to = email.to;
		$scope.edit_email_subject = email.subject;
		$scope.edit_email_template = email.template;
		$scope.edit_index = index;

	};

	//edit email
	$scope.saveEditedEmail = function(index) {
		$scope.loading = true;

		var email = $scope.emails[index];

		$http.put($scope.apiPath + 'emails/' + email.id,{
			currency: $scope.edit_email_currency,
			from: $scope.edit_email_from,
			to: $scope.edit_email_to,
			subject: $scope.edit_email_subject,
			template: $scope.edit_email_template,
			csrf_token : $scope.csrf_token
		})
			.success(function(data, status, headers, config) {
				$scope.emails[index] = data;
				$scope.editEmail = true;
				$scope.loading = false;
			});;
	};


	//email
	//create new discount
	$scope.createDiscount = function() {
		$scope.loading = true;

		$http.post($scope.apiPath + 'discounts', {
			currency: $scope.discount_currency,
			percentage: $scope.discount_percentage,
			csrf_token : $scope.csrf_token
		}).success(function(data, status, headers, config) {
			$scope.discount = data;
			$scope.discount_currency ='';
			$scope.discount_percentage ='';
			$scope.newDiscount = true;
			$scope.discount_percentage_error = true;
			$scope.discount_currency_error = true;
			$scope.discounts.push(data);
			$scope.loading = false;
		}).error(function(data, status, headers, config) {
			$scope.errors = data;

			if($scope.errors.currency!=null)
				$scope.discount_currency_error = false;
			else
				$scope.discount_currency_error = true;
			if($scope.errors.percentage != null)
				$scope.discount_percentage_error = false;
			else
				$scope.discount_percentage_error = true;

			$scope.loading = false;
		});
	};

	//remove discount
	$scope.removeDiscount = function(index) {
		$scope.loading = true;

		var discount = $scope.discounts[index];

		$http.delete($scope.apiPath + 'discounts/' + discount.id)
			.success(function() {
				$scope.discounts.splice(index, 1);
				$scope.loading = false;
			});;
	};

		//display edit discount
		$scope.showEditDiscount = function(index) {
			$scope.loading = true;
			$scope.editDiscount = false;

			var discount = $scope.discounts[index];

			$scope.edit_currency = discount.currency;
			$scope.edit_percentage = discount.percentage;
			$scope.edit_index = index;

		};

		//edit discount
		$scope.saveEditedDiscount = function(index) {
			$scope.loading = true;
			var discount = $scope.discounts[index];


			$http.put($scope.apiPath + 'discounts/' + discount.id,{
				currency: $scope.edit_currency,
				percentage: $scope.edit_percentage
			})
				.success(function(data, status, headers, config) {
					$scope.discounts[index] = data;
					$scope.editDiscount = true;
					$scope.loading = false;
				});;
		};

	//surcharge
	$scope.getSurcharge= function(exchangeCurrencyName,  sendingAmount){
	//return surcharge
	$http.get($scope.apiPath + 'surcharges/getAmount',{
		params: {
			currencyName: exchangeCurrencyName,
			sendingAmount: sendingAmount
	}}).
	success(function(data, status, headers, config) {
		$scope.surcharge = data;
		$scope.hideSurcharge = false;
		$scope.loading = false;
	});
	};

	//create new surcharge
	$scope.createSurcharge = function() {
		$scope.loading = true;

		$http.post($scope.apiPath + 'surcharges', {
			currency: $scope.surcharge_currency,
			percentage: $scope.surcharge_percentage,
			csrf_token : $scope.csrf_token
		}).success(function(data, status, headers, config) {
			$scope.surcharge = data;
			$scope.surcharge_currency ='';
			$scope.surcharge_percentage ='';
			$scope.newSurcharge = true;
			$scope.surcharge_percentage_error = true;
			$scope.surcharge_currency_error = true;
			$scope.surcharges.push(data);
			$scope.loading = false;
		}).error(function(data, status, headers, config) {
			$scope.errors = data;
			if($scope.errors.percentage != null && $scope.errors.currency != null){
				$scope.surcharge_percentage_error = false;
				$scope.surcharge_currency_error = false;
			}else if ($scope.errors.percentage != null) {
				$scope.surcharge_percentage_error = false;
				$scope.surcharge_currency_error = true;
			}
			else{
				$scope.surcharge_percentage_error = true;
				$scope.surcharge_currency_error = false;
			}
			$scope.loading = false;
		})
	};

	//remove surcharge
	$scope.removeSurcharge = function(index) {
		$scope.loading = true;

		var surcharge = $scope.surcharges[index];

		$http.delete($scope.apiPath + 'surcharges/' + surcharge.id)
			.success(function() {
				$scope.surcharges.splice(index, 1);
				$scope.loading = false;
			});;
	};

	//display edit surcharge
	$scope.showEditSurcharge = function(index) {
		$scope.loading = true;
		$scope.editSurcharge = false;

		var surcharge = $scope.surcharges[index];

		$scope.edit_currency = surcharge.currency;
		$scope.edit_percentage = surcharge.percentage;
		$scope.edit_index = index;

	};

	//edit surcharge
	$scope.saveEditedSurcharge = function(index) {
		$scope.loading = true;
		var surcharge = $scope.surcharges[index];


		$http.put($scope.apiPath + 'surcharges/' + surcharge.id,{
			currency: $scope.edit_currency,
			percentage: $scope.edit_percentage
		})
			.success(function(data, status, headers, config) {
				$scope.surcharges[index] = data;
				$scope.editSurcharge = true;
				$scope.loading = false;
			});;
	};


	//exchanged rates
	//create new exchange rate
	$scope.createExchangeRate = function() {
		$scope.loading = true;

		$http.post($scope.apiPath + 'rates', {
			name: $scope.rate_name,
			source: $scope.rate_source,
			rate: $scope.rate_value,
			csrf_token : $scope.csrf_token
		}).success(function(data, status, headers, config) {
			$scope.rate = data;
			$scope.rate_name ='';
			$scope.rate_source ='';
			$scope.rate_value ='';
			$scope.rates.push(data);
			$scope.loading = false;
		});
	};
	//remove rate
	$scope.removeExchangeRate = function(index) {
		$scope.loading = true;

		var rate = $scope.rates[index];

		$http.delete($scope.apiPath + 'rates/' + rate.id)
			.success(function() {
				$scope.rates.splice(index, 1);
				$scope.loading = false;
			});;
	};


	//purchase order
	$scope.purchaseOrder = function() {
		$scope.loading = true;

		$http.post($scope.apiPath + 'orders', {
				exchanged_currency: $scope.exchangeCurrency.name,
				exchanged_rate: $scope.exchangeCurrency.rate,
				purchased_amount: $scope.receivingAmount,
				surcharge_amount: $scope.surcharge.chargeValue,
				surcharge_percentage: $scope.surcharge.percentage,
				paid_amount: $scope.sendingAmount,
				status: 0,
				csrf_token : $scope.csrf_token
			 }).success(function(data, status, headers, config) {
						 $scope.orders = data;
						 $scope.confirmOrder = false;
						 paid_amount: $scope.sendingAmount,
			 			 $scope.loading = false;
		});
	};

	//confirm order
	$scope.confirm = function() {
		$scope.loading = true;
		$scope.confirmOrder = true;
		$scope.confirmed = false;
		$http.put($scope.apiPath + 'orders/'+ $scope.orders.id,{
				status: 1,
				csrf_token : $scope.csrf_token
		})
			.success(function(data, status, headers, config) {
						 $scope.orders = data;
						 $scope.exchangeCurrency= false;
						 $scope.exchangeCurrency.name ='';
						 $scope.exchangeCurrency.rate ='';
						 $scope.receivingAmount ='';
						 $scope.sendingAmount ='';
			 			 $scope.loading = false;
		});
		$timeout(function(){$scope.confirmed = true}, 3000);
	};


	//cancel order
	$scope.cancelOrder = function(id) {
		$scope.loading = true;
		$scope.confirmOrder = true;


		$http.delete($scope.apiPath + 'orders/' + id)
			.success(function() {
				$scope.removed = true;
				$scope.removedOrder = false;

				$scope.loading = false;
			});

			$timeout(function(){$scope.removedOrder = true}, 3000);
	};

	$scope.updateRates = function (){
		$scope.loading = true;
		$http.get($scope.apiPath + 'rates/updateRates', {})
			.success(function(data, status, headers, config) {
						 $scope.rates = data;
			 			 $scope.loading = false;
					 });
	};
	//custom
	$scope.displayNewSurcharge = function(){
		if($scope.newSurcharge)
		 $scope.newSurcharge = false;
		else
		 $scope.newSurcharge = true;
	};

	//custom
	$scope.displayNewAction = function(){
		if($scope.newAction)
		 $scope.newAction = false;
		else
		 $scope.newAction = true;
	};

	$scope.displayNewEmail = function(){
		if($scope.newEmail)
		 $scope.newEmail = false;
		else
		 $scope.newEmail = true;
	};

	$scope.displayNewDiscount = function(){
		if($scope.newDiscount)
		 $scope.newDiscount = false;
		else
		 $scope.newDiscount = true;
	};

	$scope.init();

});
