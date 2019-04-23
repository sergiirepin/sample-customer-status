<?php

namespace Repin\CustomerStatus\Plugin\CustomerData;

use Magento\Customer\Helper\Session\CurrentCustomer;

class Customer
{
    protected $currentCustomer;

    public function __construct(
        CurrentCustomer $currentCustomer
    )
    {
        $this->currentCustomer = $currentCustomer;
    }

    public function afterGetSectionData(\Magento\Customer\CustomerData\Customer $subject, $result)
    {
        $customer = $this->currentCustomer->getCustomer();
        $result['status'] = $customer->getCustomAttribute('customer_status')->getValue();
        return $result;
    }
}