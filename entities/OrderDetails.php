<?php

class OrderDetails implements JsonSerializable
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
                $name = str_replace('_', ' ', $name);
                $name = ucwords($name);
                $name = str_replace(' ', '', $name);
            }

            if (method_exists($this, 'set'.$name)) {
                $this->{'set'.$name}($value);
            }
        }
    }

    private $id;
    private $srcOrderId;
    private $orderDetails;

    /**
     * Set id
     *
     * @param int $id
     * @return OrderDetails
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
     * Set srcOrderId
     *
     * @param int $srcOrderId
     * @return OrderDetails
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
     * Set orderDetails
     *
     * @param string $orderDetails
     * @return OrderDetails
     */
    public function setOrderDetails($orderDetails)
    {
        $this->orderDetails = $orderDetails;

        return $this;
    }

    /**
     * Get orderDetails
     *
     * @return string
     */
    public function getOrderDetails()
    {
        return $this->orderDetails;
    }
}
