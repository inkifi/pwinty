<?php
/**
 * 2019-05-15
 * @used-by \Inkifi\Pwinty\Controller\Index\Index::execute()
 * @used-by \Inkifi\Pwinty\Plugin\Shipping\Model\Order\Track::aroundGetNumberDetail()
 * @param string $url
 * @return string
 */
function ikf_pw_carrier($url) {return $url ? df_domain($url) : 'Unknown';}