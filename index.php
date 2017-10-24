<?php

require_once('header.php');
require_once('entities/PurchaseOrderRepository.php');

function getOrders(array $search) {
    $purchaseRepository = new PurchaseOrderRepository();
    $orders             = $purchaseRepository->findBy($search);

    return $orders;
}

$possibleSearchParams = [
    'PRIMARY_KEY'            => 'i',
    'ORDER_ACCOUNT_NAME'     => 's',
    'BILLING_ACCOUNT_NUMBER' => 'i',
    'SRC_CUSTOMER_ID'        => 'i',
    'SRC_ORDER_ID'           => 'i',
    'WIP_MRC'                => 'i',
    'FIRST_SD_ACCEPTED_DATE' => 's',
    'PIPELINE_REPORTED_DATE' => 's',
];

$searchParams = [];

foreach ($_POST as $key => $value) {
    if (array_key_exists($key, $possibleSearchParams) && $value != '') {
        $searchType = $possibleSearchParams[$key];

        $searchParams[$key] = [
            'type'  => $searchType,
            'query' => $searchType == 'i' ? (int)$value : $value,
        ];
    }
}

$repository = new PurchaseOrderRepository();
$orders     = $repository->findAllOrders();

if (count($searchParams)) {
    $orders = getOrders($searchParams);
}

?>

<div class="container">
    <h4>
        Search
        <small>
        <?php
            foreach ($searchParams as $key => $value) {
                echo '<span class="label label-default">'.$key.': "'.$value['query'].'"</span>';
            }
        ?>
        </small>
    </h4>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-3">
                <input class="form-control" name="PRIMARY_KEY" placeholder="ID">
                <br>
                <input class="form-control" name="ORDER_ACCOUNT_NAME" placeholder="Order account name">
            </div>
            <div class="col-md-3">
                <input class="form-control" name="BILLING_ACCOUNT_NUMBER" placeholder="Billing account number">
                <br>
                <input class="form-control" name="SRC_CUSTOMER_ID" placeholder="Customer ID">
            </div>
            <div class="col-md-3">
                <input class="form-control" name="SRC_ORDER_ID" placeholder="Order ID">
                <br>
                <input class="form-control" name="WIP_MRC" placeholder="WIP MRC">
            </div>
            <div class="col-md-3">
                <input class="form-control" name="FIRST_SD_ACCEPTED_DATE" placeholder="Service delivery date">
                <br>
                <input class="form-control" name="PIPELINE_REPORTED_DATE" placeholder="Pipeline date">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">
            Search
        </button>
    </form>
    <hr>
    <h4>Orders</h4>
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
                <p id="js-modal-order-details"></p>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
