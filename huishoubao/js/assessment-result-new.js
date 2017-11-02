var Evaluate = {
    config: {

        
    },
    init: function() {
        this.bindEvent()
        this.getPerson(config.itemid)
    },
    bindEvent: function() {
        
        $('.evaluate-detail-more-btn').on('tap', function() {
            $(this).toggleClass('active');
            $('.evaluate-detail').toggleClass('active');
        });

    },
    getPerson: function(itemid) {
        var that = this;

        $.get('/php/index.php/www2/api/openapi/json/get_product_num?productid=' + itemid, function(data) {
            if(data.ret == 0) {
                $('.recovery-record').find('span').text(that.format(data.data.Fproduct_num));
                
            }
        });
    },
    format: function(num) {  
        var reg=/(?=(?!\b)(\d{3})+$)/g;  
        return String(num).replace(reg, ',');  
    }
};
$(function() {
    Evaluate.init()
});