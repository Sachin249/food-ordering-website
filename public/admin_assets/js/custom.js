function addtoCart()
{
    // jQuery('#pqty').val(jQuery('#quantity_val').val());
    // jQuery('#product_price').val(jQuery('.pro_price').val())
    // jQuery('#product_id').val(jQuery('.pro_id').val())
    jQuery.ajax({
        url:'/add_to_cart',
        data :jQuery('#fromAddToCart').serialize(),
        type:'post',
        success:function(result){
            alert('Product '+result.msg)
            window.location.href="/user/homepage/mycart/";
        }
    })
}
function updateQty(pid,price)
{
    
    var qty=jQuery('#quantity_val'+pid).val();
    var Qty=Object.values(qty);
    jQuery('#quantity_val').val(Qty);
    jQuery('#product_id').val(pid);
    // addtoCart();
    jQuery('#pqty').val(jQuery('#quantity_val').val());
    jQuery.ajax({
        url:'/update_cart',
        data :jQuery('#fromAddToCart').serialize(),
        type:'post',
        success:function(result){
            alert('Product '+result.msg)
        }
    })
    jQuery('#total'+pid).val(Qty*price);
    location.reload();
}

jQuery('#frmPlaceOrder').submit(function(e)
{
    jQuery('#place_order_msg').html("Please wait ...");
    e.preventDefault();
    jQuery.ajax({
        url:'/place_order',
        data:jQuery('#frmPlaceOrder').serialize(),
        type:'post',
        success:function(result)
        {
           if(result.status=="success")
           {
               if(result.payment_url!='')
               {
                    window.location.href=result.payment_url;
               }
               else
               {
                    window.location.href="/order_placed";
               }
                
           }
           jQuery('#place_order_msg').html(result.msg);
        }
    });
});

function applyCouponCode()
{
    jQuery("#coupon_code_msg").html("");
    var coupon_code=jQuery('#coupon_code').val();
    if(coupon_code != '')
    {
        jQuery.ajax({
            type:'post',
            url:'/apply_coupon_code',
            data:'coupon_code='+coupon_code+'&_token='+jQuery("[name='_token']").val(),
            success:function(result)
            {
               
               if(result.status=="success")
               {
                    jQuery('.coupon_box').removeClass('hide');
                    jQuery('.coupan_code_value').html(coupon_code);
                    // jQuery('.coupon_value').val(result.coupon_value);
                    // jQuery('.coupon_type').val(result.coupon_type);
                    jQuery('.totalprice').val(result.totalprice);
                    jQuery('#coupon_code_msg').html(result.msg);
                    jQuery('.apply_coupon_disable').hide();
               }
               else
               {
                    jQuery('#coupon_code_msg').html(result.msg);
               }
            }
        });
    }
    else{
        jQuery("#coupon_code_msg").html("Please enter valid coupon code");
    }
}

function remove_coupon_code()
{
    jQuery("#coupon_code_msg").html("");
    var coupon_code=jQuery('#coupon_code').val();
    jQuery('#coupon_code').val('');
    if(coupon_code != '')
    {
        jQuery.ajax({
            type:'post',
            url:'/remove_coupon_code',
            data:'coupon_code='+coupon_code+'&_token='+jQuery("[name='_token']").val(),
            success:function(result)
            {
               
               if(result.status=="success")
               {
                    jQuery('.coupon_box').addClass('hide');
                    jQuery('.coupan_code_value').html('');
                    jQuery('.totalprice').val(result.totalprice);
                    jQuery('#coupon_code_msg').html(result.msg);
                    jQuery('.apply_coupon_disable').show();
               }
               else
               {
                    jQuery('#coupon_code_msg').html(result.msg);
               }
            }
        });
    }
    else{
        jQuery("#coupon_code_msg").html("Please enter valid coupon code");
    }
}

function apply_coupon(cid)
{
    var coupon=jQuery('#apply_coupon'+cid).val();
    jQuery('#coupon_code').val(coupon);
}
