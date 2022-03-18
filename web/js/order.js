let orderItemsCount = 0;

$(function (){
    $(".add-order-item").on("click", function (){
        $.ajax({
            url: '/add-order-item',
            type: 'post',
            data: {},
            beforeSend: function () {

            },
            success: function (data) {
                if (typeof data.format !== "undefined" && data.format === "json") {
                    let container = $(".order-items");
                    container.append(JSON.parse(data.response));

                    //add css class to dynamic fields
                    container.find('.row').last().find('.form-group').addClass('m-2')

                    //increment number to input id
                    let newFieldKeyProduct = 'orderitem'+(++orderItemsCount)+'-product_id';
                    container
                        .find("select")
                        .last()
                        .prop('id', newFieldKeyProduct);

                    let newFieldKeyCount = 'orderitem'+(++orderItemsCount)+'-count';
                    container
                        .find("input")
                        .last()
                        .prop('id', newFieldKeyCount);
                }
            },
            error: function (e) {

            },
            complete: function () {

            }
        });
    });
});