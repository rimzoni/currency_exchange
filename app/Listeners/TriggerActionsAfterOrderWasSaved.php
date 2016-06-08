<?php

namespace App\Listeners;

use Mail;
use App\Events\OrderSaved;
use App\Classes\Calculations;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Repositories\Interfaces\ActionRepositoryInterface;
use App\Repositories\Interfaces\DiscountRepositoryInterface;
use App\Repositories\Interfaces\EmailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class TriggerActionsAfterOrderWasSaved
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ActionRepositoryInterface $action,DiscountRepositoryInterface $discount, EmailRepositoryInterface $email, OrderRepositoryInterface $order, Calculations $calculations)
    {
        $this->action = $action;
        $this->discount = $discount;
        $this->email = $email;
        $this->order = $order;
        $this->calculations = $calculations;
    }

    /**
     * Handle the event.
     *
     * @param  OrderSaved  $event
     * @return void
     */
    public function handle(OrderSaved $event)
    {
      $currencyName = $event->order["exchanged_currency"];
      $orderId = $event->order["id"];
      $orderObject = $event->order['attributes'];
      $total_amount = $event->order["total_amount"];
      $actionObject = $this->action->find($currencyName);
      $hasAction = $actionObject->has_action ?  : false;
      $currencyAction = $actionObject->action;

      $data = array('order'=>$event->order);

      if($hasAction){
        if($currencyAction=='discount'){
          $discountObject = $this->discount->find($currencyName);
          $percentage = $discountObject->percentage;
          $discount_reponse = $this->calculations->calculateDiscountAmount($data,$percentage);
          $discount_value = $discount_reponse['discountValue'];


          $orderObject['discount_amount'] = $discount_value;
          $orderObject['discount_percentage'] = floatval($percentage);
          $orderObject['total_amount'] = $total_amount - $discount_value;

          //update order
          $order_update = $this->order->updateOrder($orderObject);

        }elseif ($currencyAction=='email') {
          $emailObject = $this->email->find($currencyName);

          //move sending email to queue to prevent user wait
          Mail::send($emailObject->template,$data , function ($message) use ($emailObject)
          {

              $message->from($emailObject->from,'Customer Sales');

              $message->to($emailObject->to);

              $message->subject($emailObject->subject);

          });
        }
      }
    }
}
