<?php

declare(strict_types=1);

namespace App\Actions;

use App\DTOs\OrderData;
use App\Models\Bun;
use App\Models\Filling;
use App\Models\Order;
use Psr\Log\LoggerInterface;

final class CreateOrderAction
{
    public function __construct(private LoggerInterface $logger)
    {

    }
    public function handle(OrderData $orderData): Order
    {
        $fillings = Filling::whereIn('pkid', $orderData->getFillings())->get();
        $bun = Bun::where('pkid', $orderData->getBun())->first();

        $price = $bun->price;

        foreach ($fillings as $filling) {
            $price += $filling->price;
        }

        $order = Order::create([
            'bunId' => $orderData->getBun(),
            'crewId' => 1, // Defaulting for now..
            'price' => $price,
            'fillingId' => $fillings->first()->pkid
        ]);

        $this->logger->info(sprintf('New order %s has been created!', $order->id));

        return $order;
    }

}