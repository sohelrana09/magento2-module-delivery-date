<?php
namespace SR\DeliveryDate\Model;

use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    const XPATH_FORMAT                 = 'sr_deliverydate/general/format';
    const XPATH_DISABLED               = 'sr_deliverydate/general/disabled';
    const XPATH_HOURMIN                = 'sr_deliverydate/general/hourMin';
    const XPATH_HOURMAX                = 'sr_deliverydate/general/hourMax';
    const XPATH_REQUIRED_DELIVERY_DATE = 'sr_deliverydate/general/required_delivery_date';

    /**
     * @var int
     */
    protected $storeId;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Config constructor.
     *
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        $store = $this->getStoreId();

        return $this->scopeConfig->getValue(self::XPATH_FORMAT, ScopeInterface::SCOPE_STORE, $store);
    }

    /**
     * @return mixed
     */
    public function getDisabled()
    {
        $store = $this->getStoreId();
        return $this->scopeConfig->getValue(self::XPATH_DISABLED, ScopeInterface::SCOPE_STORE, $store);
    }

    /**
     * @return mixed
     */
    public function getHourMin()
    {
        $store = $this->getStoreId();
        return $this->scopeConfig->getValue(self::XPATH_HOURMIN, ScopeInterface::SCOPE_STORE, $store);
    }

    /**
     * @return mixed
     */
    public function getHourMax()
    {
        $store = $this->getStoreId();
        return $this->scopeConfig->getValue(self::XPATH_HOURMAX, ScopeInterface::SCOPE_STORE, $store);
    }

    /**
     * @return mixed
     */
    public function getRequiredDeliveryDate()
    {
        $store = $this->getStoreId();
        return (bool) $this->scopeConfig->getValue(self::XPATH_REQUIRED_DELIVERY_DATE, ScopeInterface::SCOPE_STORE, $store);
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        if (!$this->storeId) {
            $this->storeId = $this->storeManager->getStore()->getStoreId();
        }
        return $this->storeId;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig()
    {
        $disabled = $this->getDisabled();
        $hourMin = $this->getHourMin();
        $hourMax = $this->getHourMax();
        $format = $this->getFormat();

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