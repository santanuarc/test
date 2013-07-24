<form name="paypalFRM" method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" target="_top">
<input type="hidden" name="business" value="rahuls_1351402331_biz@arcinfotec.com">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="return" value="http://192.168.1.40/luz/process.php?MemberID=3&amp;todo=pay_success&amp;ID=2">
<input type="hidden" name="cancel_return" value="http://192.168.1.40/luz/process.php?MemberID=3&amp;todo=pay_unsuccess&amp;ID=2">
<input type="hidden" name="notify_url" value="http://192.168.1.40/luz/notifyurl.php"><input type="hidden" name="rm" value="2">
<input type="hidden" name="lc" value="GB">
<input type="hidden" name="image_url" value="http://www.yoreservo.com/luz/admin/images/paypal_logo.png">
<input type="hidden" name="quantity" value="1"><input type="hidden" name="quantity" value="1">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="item_name" value="INTERARTE Subscription">
<input type="hidden" name="amount" id="paypalamt" value="200.00">
<input type="hidden" name="cpp_cart_border_color" value="333333">
<input type="hidden" name="cpp_headerback_color" value="333333">
<input type="hidden" name="cpp_headerborder_color" value="333333">
<input type="hidden" name="cpp_payflow_color" value="333333">
</form>
<input type="button" class="button2" name="PayNow" id="PayNow" value="PAY NOW" onclick="document.paypalFRM.submit();">