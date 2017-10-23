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
                <td><?php echo $order->getId(); ?></td>
                <td><?php echo $order->getOrderAccountName(); ?></td>
                <td><?php echo $order->getBillingAccountNumber(); ?></td>
                <td><?php echo $order->getSrcCustomerId(); ?></td>
                <td><?php echo $order->getSrcOrderId(); ?></td>
                <td><?php echo $order->getWipMrc(); ?></td>
                <td><?php echo $order->getFirstSdAcceptedDate()->format('m/d/Y'); ?></td>
                <td><?php echo $order->getPipelineReportedDate()->format('m/d/Y'); ?></td>
                <td>
                    <a href="<?php echo 'orderDetail.php?orderId='.$order->getId(); ?>" class="btn btn-default btn-xs js-show-details" data-order-id="<?php echo $order->getId(); ?>">
                        Details
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div class="modal fade" id="js-order-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</span></button>
                <h4 class="modal-title">Order</h4>
            </div>
            <div class="modal-body">
                <h4>Order Summary</h4>
                <table class="table table-striped">
                    <tbody id="js-modal-order-summary"></tbody>
                </table>
                <hr>
                <h4>Order Details</h4>
                <p>Details would go here...</p>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
