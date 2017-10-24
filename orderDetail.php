<?php

require_once('entities/PurchaseOrderRepository.php');

function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function getOrder($orderId) {
    $purchaseRepository = new PurchaseOrderRepository();
    $order              = $purchaseRepository->findOrderById($orderId);

    return $order;
}

if (is_ajax()):
    // check for orderId in post
    if (! isset($_POST["orderId"]) || (isset($_POST["orderId"]) && empty($_POST["orderId"]))) {
        echo 'Error: No order.';
        return;
    }

    echo json_encode(getOrder($_POST["orderId"]));
else:
    require_once('header.php');

    // check for orderId in get
    if (! isset($_GET["orderId"]) || (isset($_GET["orderId"]) && empty($_GET["orderId"]))) {
        echo 'Error: No order.';
        return;
    }

    $order = getOrder($_GET["orderId"]);

?>

    <div class="container">
        <h4>Order Summary</h4>
        <table class="table table-striped">
            <?php if (! $order): ?>
                <tr>
                    <td colspan="2">No order found.</td>
                </tr>
            <?php else: ?>
                <tr>
                    <th>ID</th>
                    <td><?php echo $order->getId(); ?></td>
                </tr>
                <tr>
                    <th>Order Account Name</th>
                    <td><?php echo $order->getOrderAccountName(); ?></td>
                </tr>
                <tr>
                    <th>Billing Account Number</th>
                    <td><?php echo $order->getBillingAccountNumber(); ?></td>
                </tr>
                <tr>
                    <th>Customer ID</th>
                    <td><?php echo $order->getSrcCustomerId(); ?></td>
                </tr>
                <tr>
                    <th>Order ID</th>
                    <td><?php echo $order->getSrcOrderId(); ?></td>
                </tr>
                <tr>
                    <th>WIP MRC</th>
                    <td><?php echo $order->getWipMrc(); ?></td>
                </tr>
                <tr>
                    <th>Service Delivery Date</th>
                    <td><?php echo $order->getFirstSdAcceptedDate()->format('m/d/Y'); ?></td>
                </tr>
                <tr>
                    <th>Pipeline Date</th>
                    <td><?php echo $order->getPipelineReportedDate()->format('m/d/Y'); ?></td>
                </tr>
            </table>

            <hr>

            <h4>Order Details</h4>
            <p>Details would go here...</p>
        <?php endif; ?>
    </div>

<?php
endif;
