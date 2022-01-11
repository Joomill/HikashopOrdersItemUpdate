<?php
/*
 *  package: Hikashop Orders Item Update
 *  copyright: Copyright (c) 2022. Jeroen Moolenschot | Joomill
 *  license: GNU General Public License version 3 or later
 *  link: https://www.joomill-extensions.com
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class plgHikashopOrder_update_value extends JPlugin
{
	var $message = '';

	function __construct(&$subject, $config){
		parent::__construct($subject, $config);
		$pluginsClass = hikashop_get('class.plugins');
		
	}
		
	function onAfterOrderCreate(&$order) {	
		$orderClass = hikashop_get('class.order');
		$orderdata = $orderClass->loadFullOrder($order->order_id);		
		
		foreach($orderdata->products as $product){		
			$order_product_id = $product->order_product_id;
			$product_id = $product->product_id;
			$productClass = hikashop_get('class.product');
			$productData = $productClass->get($product_id);	
			$field = $productData->product_locatie;
			
			Factory::getDBO()->setQuery("UPDATE `#__hikashop_order_product` SET `order_product_locatie` = \"$field\" WHERE `order_product_id` = $order_product_id")->execute();
		}			
	}
}