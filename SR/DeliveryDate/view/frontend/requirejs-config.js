var config = {
    "map": {
        "*": {
            'Magento_Checkout/js/model/shipping-save-processor/default': 'SR_DeliveryDate/js/model/shipping-save-processor/default'
        }
    },
    config: {
        mixins: {
            'Magento_Checkout/js/view/shipping': {
                'SR_DeliveryDate/js/mixin/shipping-mixin': true
            },
            'Amazon_Payment/js/view/shipping': {
                'SR_DeliveryDate/js/mixin/shipping-mixin': true
            }
        }
    }
};
