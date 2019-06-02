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
        $disabled = $this->config->getDisabled();
        $hourMin = $this->config->getHourMin();
        $hourMax = $this->config->getHourMax();
        $format = $this->config->getFormat();
        
        $noday = 0;
        if($disabled == -1) {
            $noday = 1;
        }

        $config = [
            'shipping' => [
                'delivery_date' => [
                    'format' => $format,
                    'disabled' => $disabled,
                    'noday' => $noday,
                    'hourMin' => $hourMin,
                    'hourMax' => $hourMax
                ]
            ]
        ];

        return $config;
    }
}