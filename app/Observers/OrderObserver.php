<?php

namespace App\Observers;

use App\Models\Order;
use App\Notifications\CartNotification;

class OrderObserver
{
    private array $added;
    private array $rejected;
    private array $accepted;
    private array $sent;
    private array $delivered;

    public function setData(Order $order)
    {
        $this->added = [
            'header' => "Your Cart Paid",
            'button' => "Follow up your Cart",
            'url' => "https://www.snappfood.ir",
            'body' => "Your Cart Price is: {$order->calculateTotal()}"
        ];
        $this->accepted = [
            'header' => "Your Cart Accepted by {$order->restaurant->name}",
            'button' => "Follow up your Cart",
            'url' => "https://www.snappfood.ir",
            'body' => "Your foods is now in progress and soon would be sending "
        ];
        $this->rejected = [
            'header' => "Your Cart denied by {$order->restaurant->name}",
            'button' => "Make New Cart",
            'url' => "https://www.snappfood.ir",
            'body' => "Sorry about this. Your money will keep in your wallet. If you Want we can return your money in 2 hour "
        ];
        $this->sent = [
            'header' => "Your Food Is Ready. We send your food in any minute",
            'button' => "See Your shipment information",
            'url' => "https://www.snappfood.ir",
            'body' => "We hope Your food delivered to You as hot as we sent"
        ];

        $this->delivered = [
            'header' => "Your Food Delivered",
            'button' => "Share Your Opinion with us",
            'url' => "https://www.snappfood.ir",
            'body' => "Please Comment and score your food and restaurant. Your Comments help Other to get better food."
        ];
    }

    /**
     * @param Order $order
     * @param array $data
     * @return void
     */
    public function notify(Order $order,array $data)
    {
        $order->user->notify(new CartNotification($data));
    }

    /**
     * Handle the Order "created" event.
     *
     * @param \App\Models\Order $order
     * @return void
     */

    /**
     * Handle the Order "updated" event.
     *
     * @param \App\Models\Order $order
     * @return void
     */
    public function updated(Order $order)
    {
        $this->setData($order);
        if ($order->isDirty('status')) {
            switch ($order->status) {
                case Order::ADDED:
                    $data = $this->added;
                    $order->saveQuietly(['total_price'=>$order->calculateTotal()]);
                    break;
                case Order::REJECTED:
                    $data = $this->rejected;
                    break;
                case Order::INPROGRESS:
                    $data = $this->accepted;
                    break;
                case Order::SENDING:
                    $data = $this->sent;
                    break;
                default:
                    $data = $this->delivered;
            }
            $this->notify($order,$data);
        }
    }


}
