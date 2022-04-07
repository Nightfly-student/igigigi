<?php

class initializeMollie
{
    public function initialize()
    {
        $mollie = new \Mollie\Api\MollieApiClient();
        $mollie->setApiKey("test_Ds3fz4U9vNKxzCfVvVHJT2sgW5ECD8");
        return $mollie;
    }
}
