define(
    [
        'Magento_Ui/js/form/element/abstract'
    ], function(
        Abstract
    ) {
    return Abstract.extend({
        initialize: function () {
            return this._super();
        },
        getImage: function () {
            if (this.value()) {
                return '<img src="/media/weatherfeed/icons/' + this.value() + '@2x.png" border="0" ">';
            }
        }
    });
});