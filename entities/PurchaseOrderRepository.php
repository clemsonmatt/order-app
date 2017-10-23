<?php

require_once('PurchaseOrder.php');
require_once('config/Database.php');

class PurchaseOrderRepository
{
    public function findAllOrders()
    {
        // $orders = [];

        // for ($i = 0; $i < 10; $i++) {
        //     $orders[] = $this->createOrder();
        // }

        $db   = new Database();
        $conn = $db->getConnection();

        $query = oci_parse($conn, 'SELECT * FROM EXAMPLE.TEST_DATA_SUMMARY');
        oci_execute($query);

        $orders = oci_fetch_array($query, OCI_ASSOC+OCI_RETURN_NULLS);

        return $orders;
    }

    public function findOrderById(int $id)
    {
        $order = $this->createOrder($id);

        return $order;
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
