<?php

/**
 * DB Fields:
 *
 * PRIMARY_KEY
 * ORDER_ACCOUNT_NAME - the name on the account
 * BILLING_ACCOUNT_NUMBER - billing account #
 * SRC_CUSTOMER_ID - location account ID
 * SRC_ORDER_ID - order number
 * WIP_MRC - revenue associated with the order
 * FIRST_SD_ACCEPTED_DATE - date order was brought into service delivery
 * PIPELINE_REPORTED_DATE - date order was completed and pushed into billing
 */

class PurchaseOrder implements JsonSerializable
{
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function hydrate(array $result)
    {
        foreach ($result as $name => $value) {
            if ($name == 'PRIMARY_KEY') {
                $name = 'Id';
            } else {
                if (in_array($name, ['FIRST_SD_ACCEPTED_DATE', 'PIPELINE_REPORTED_DATE'])) {
                    $value = new \DateTime($value);
                }

                $name = str_replace('_', ' ', $name);
                $name = ucwords($name);
                $name = str_replace(' ', '', $name);
            }

            $this->{'set'.$name}($value);
        }
    }

    private $id;
    private $orderAccountName;
    private $billingAccountNumber;
    private $srcCustomerId;
    private $srcOrderId;
    private $wipMrc;
    private $firstSdAcceptedDate;
    private $pipelineReportedDate;

    /**
     * Set id
     *
     * @param int $id
     * @return PurchaseOrder
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set orderAccountName
     *
     * @param string $orderAccountName
     * @return PurchaseOrder
     */
    public function setOrderAccountName($orderAccountName)
    {
        $this->orderAccountName = $orderAccountName;

        return $this;
    }

    /**
     * Get orderAccountName
     *
     * @return string
     */
    public function getOrderAccountName()
    {
        return $this->orderAccountName;
    }

    /**
     * Set billingAccountNumber
     *
     * @param int $billingAccountNumber
     * @return PurchaseOrder
     */
    public function setBillingAccountNumber(int $billingAccountNumber)
    {
        $this->billingAccountNumber = $billingAccountNumber;

        return $this;
    }

    /**
     * Get billingAccountNumber
     *
     * @return int
     */
    public function getBillingAccountNumber()
    {
        return $this->billingAccountNumber;
    }

    /**
     * Set srcCustomerId
     *
     * @param int $srcCustomerId
     * @return PurchaseOrder
     */
    public function setSrcCustomerId(int $srcCustomerId)
    {
        $this->srcCustomerId = $srcCustomerId;

        return $this;
    }

    /**
     * Get srcCustomerId
     *
     * @return int
     */
    public function getSrcCustomerId()
    {
        return $this->srcCustomerId;
    }

    /**
     * Set srcOrderId
     *
     * @param int $srcOrderId
     * @return PurchaseOrder
     */
    public function setSrcOrderId(int $srcOrderId)
    {
        $this->srcOrderId = $srcOrderId;

        return $this;
    }

    /**
     * Get srcOrderId
     *
     * @return int
     */
    public function getSrcOrderId()
    {
        return $this->srcOrderId;
    }

    /**
     * Set wipMrc
     *
     * @param string $wipMrc
     * @return PurchaseOrder
     */
    public function setWipMrc($wipMrc)
    {
        $this->wipMrc = $wipMrc;

        return $this;
    }

    /**
     * Get wipMrc
     *
     * @return string
     */
    public function getWipMrc()
    {
        return $this->wipMrc;
    }

    /**
     * Set firstSdAcceptedDate
     *
     * @param DateTime $firstSdAcceptedDate
     * @return PurchaseOrder
     */
    public function setFirstSdAcceptedDate(\DateTime $firstSdAcceptedDate)
    {
        $this->firstSdAcceptedDate = $firstSdAcceptedDate;

        return $this;
    }

    /**
     * Get firstSdAcceptedDate
     *
     * @return DateTime
     */
    public function getFirstSdAcceptedDate()
    {
        return $this->firstSdAcceptedDate;
    }

    /**
     * Set pipelineReportedDate
     *
     * @param DateTime $pipelineReportedDate
     * @return PurchaseOrder
     */
    public function setPipelineReportedDate(\DateTime $pipelineReportedDate)
    {
        $this->pipelineReportedDate = $pipelineReportedDate;

        return $this;
    }

    /**
     * Get pipelineReportedDate
     *
     * @return DateTime
     */
    public function getPipelineReportedDate()
    {
        return $this->pipelineReportedDate;
    }
}
