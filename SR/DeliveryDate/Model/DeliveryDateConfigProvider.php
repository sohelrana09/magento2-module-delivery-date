<?php
namespace SR\DeliveryDate\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

class DeliveryDateConfigProvider implements ConfigProviderInterface
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * DeliveryDateConfigProvider constructor.
     *
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        return $this->config->getConfig();
    }
}