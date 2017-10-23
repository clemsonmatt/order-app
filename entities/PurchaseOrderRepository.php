<?php

require_once('PurchaseOrder.php');
require_once('config/Database.php');

class PurchaseOrderRepository
{
    public function findAllOrders()
    {
        $db   = new Database();
        $conn = $db->getConnection();

        $result = $conn->query("SELECT * FROM `EXAMPLE.TEST_DATA_SUMMARY`");

        $purchaseOrders = [];

        while ($order = $result->fetch_assoc()) {
            $purchaseOrder = new PurchaseOrder();
            $purchaseOrder->hydrate($order);

            $purchaseOrders[] = $purchaseOrder;
        }

        return $purchaseOrders;
    }

    public function findOrderById(int $id)
    {
        $db   = new Database();
        $conn = $db->getConnection();

        $query = "SELECT * FROM `EXAMPLE.TEST_DATA_SUMMARY` WHERE PRIMARY_KEY = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $order  = $result->fetch_assoc();

        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->hydrate($order);

        return $purchaseOrder;
    }

    private function createId()
    {
        return substr(hexdec(uniqid(rand(10000,99999), true)), 6, 6);
    }

    private function createOrder($id = null)
    {
        $date = new \DateTime();

        if (! $id) {
            $id = $this->createId();
        }

        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->setId($id);
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
