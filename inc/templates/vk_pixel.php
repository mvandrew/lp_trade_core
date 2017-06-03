<?php
global $vk_pixel;
defined("_IN_INDEX") or die("Access Denied");
?>
<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = 'https://vk.com/rtrg?p=<?php echo $vk_pixel; ?>';</script>