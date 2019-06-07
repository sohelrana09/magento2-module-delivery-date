<?php
namespace SR\DeliveryDate\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use SR\DeliveryDate\Model\Config;
use Magento\Framework\Serialize\Serializer\Json;

class DeliveryDate extends Template
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var Json
     */
    private $json;

    /**
     * DeliveryDate constructor.
     *
     * @param Context $context
     * @param Config $config
     * @param Json $json
     * @param array $data
     */
    public function __construct(
        Context $context,
        Config $config,
        Json $json,
        array $data = []
    ) {
        $this->config = $config;
        $this->json = $json;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getConfig()
    {
        return $this->json->serialize($this->config->getConfig());
    }

    /**
     * @return mixed
     */
    public function getRequiredDeliveryDate()
    {
        return $this->config->getRequiredDeliveryDate();
    }
}