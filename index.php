<?php

require_once('header.php');

require_once('entities/PurchaseOrderRepository.php');

$repository = new PurchaseOrderRepository();
$orders     = $repository->findAllOrders();

?>

<div class="container">
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Order Account Name</th>
            <th>Billing Account Number</th>
            <th>Customer ID</th>
            <th>Order ID</th>
            <th>WIP MRC</th>
            <th>Service Delivery Date</th>
            <th>Pipeline Date</th>
        </thead>
        <?php foreach($orders as $order): ?>
            <tr>
                <td><?php echo $order->getId() ?></td>
                <td><?php echo $order->getOrderAccountName() ?></td>
                <td><?php echo $order->getBillingAccountNumber() ?></td>
                <td><?php echo $order->getSrcCustomerId() ?></td>
                <td><?php echo $order->getSrcOrderId() ?></td>
                <td><?php echo $order->getWipMrc() ?></td>
                <td><?php echo $order->getFirstSdAcceptedDate()->format('m/d/Y') ?></td>
                <td><?php echo $order->getPipelineReportedDate()->format('m/d/Y') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once('footer.php'); ?>
