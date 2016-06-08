<div class="row">
  <div class="panel panel-default">
<!-- Default panel contents -->
<div class="panel-heading">Confirm Order</div>
<!-- List group -->
<ul class="list-group">
  <li class="list-group-item">Exchanged Currency: {{ $order->exchanged_currency }}</li>
  <li class="list-group-item">Exchanged Rate: {{ $order->exchanged_rate }}</li>
  <li class="list-group-item">Paid Amount: {{ $order->paid_amount }}</li>
  <li class="list-group-item">Purchased Amount: {{ $order->purchased_amount }}</li>
  <li class="list-group-item">Surcharge Amount: {{ $order->surcharge_amount }}</li>
  <li class="list-group-item">Surcharge Percentage: {{ $order->surcharge_percentage }}%</li>
  <li class="list-group-item">Discount Amount: {{ $order->discount_amount?  : '0.00' }}</li>
  <li class="list-group-item">Discount Percentage: {{ $order->discount_percentage ?  : '0.00'}}%</li>
  <li class="list-group-item">Status: {{ $order->status==1? 'Confirmed' : 'Prepared' }}</li>
  <li class="list-group-item"></li>
  <li class="list-group-item alert alert-success" >Total Order Amount: ${{ $order->total_amount }}</li>
</ul>
<div class="panel-body">
</div>
</div>
</div>
