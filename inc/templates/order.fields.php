<?php
defined("_IN_INDEX") or die("Access Denied");

/**
 * Служебные поля формы заказа
 */
?>
	<input type="hidden" name="item" value="<?php echo _INV_NAME; ?>">
	<input type="hidden" name="qty" value="<?php echo _INV_QTY; ?>">
	<input type="hidden" name="price" value="<?php echo _INV_PRICE; ?>">
<?php if ( defined("_M1_ENABLED") && _M1_ENABLED ): ?>
	<input type="hidden" name="product_id" value="<?php echo _M1_PRODUCT; ?>">
	<input type="hidden" name="ref" value="<?php echo _M1_REF; ?>">
	<input type="hidden" name="lnk" value="<?php echo _M1_LINK; ?>">
<?php endif; ?>