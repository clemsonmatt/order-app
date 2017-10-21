<?php

require_once('PurchaseOrder.php');

class PurchaseOrderRepository
{
    public function findAllOrders()
    {
        $orders = [];

        for ($i = 0; $i < 10; $i++) {
            $orders[] = $this->createOrder();
        }

        return $orders;
    }

    private function createOrder()
    {
        $date = new \DateTime();

        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->setId($date->format('U'));
        $purchaseOrder->setOrderAccountName('John Doe');
        $purchaseOrder->setBillingAccountNumber(1234567);
        $purchaseOrder->setSrcCustomerId(7654321);
        $purchaseOrder->setSrcOrderId(1000);
        $purchaseOrder->setWipMrc(50.00);
        $purchaseOrder->setFirstSdAcceptedDate($date->modify('-5 days'));
        $purchaseOrder->setPipelineReportedDate($date);

        return $purchaseOrder;
    }
}
