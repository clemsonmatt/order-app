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

        if (! $order) {
            return;
        }

        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->hydrate($order);

        return $purchaseOrder;
    }
}
