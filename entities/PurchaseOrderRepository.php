<?php

require_once('OrderDetails.php');
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

        $query = "
            SELECT tds.*, tdd.ORDER_DETAILS FROM `EXAMPLE.TEST_DATA_SUMMARY` tds
            LEFT JOIN `EXAMPLE.TEST_DATA_DETAIL` tdd ON tds.SRC_ORDER_ID = tdd.SRC_ORDER_ID
            WHERE tds.PRIMARY_KEY = ?
        ";

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

        $orderDetails = null;

        if ($order['ORDER_DETAILS']) {
            $orderDetails = new OrderDetails();
            $orderDetails->hydrate($order);
        }

        return [$purchaseOrder, $orderDetails];
    }

    public function findBy(array $search)
    {
        $db   = new Database();
        $conn = $db->getConnection();

        $query = "
            SELECT * FROM `EXAMPLE.TEST_DATA_SUMMARY` tds
        ";

        $counter = 0;

        foreach ($search as $key => $value) {
            $query .= ($counter == 0 ? " WHERE" : " AND")." ".$key." = ?";
            $counter++;
        }

        $stmt = $conn->prepare($query);

        foreach ($search as $key => $value) {
            $stmt->bind_param($value['type'], $value['query']);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        $purchaseOrders = [];

        while ($order = $result->fetch_assoc()) {
            $purchaseOrder = new PurchaseOrder();
            $purchaseOrder->hydrate($order);

            $purchaseOrders[] = $purchaseOrder;
        }

        return $purchaseOrders;
    }
}
