<?php //$template = new AppBundle\CMS\Template\Part\Gmap(); ?>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_header.php" ?>
<div class="box-body pad contents">
	<div class="map_area">
		<div id="<?php echo $template->getId(); ?>_disp" style="width:100%; height:400px"></div>
		<?php if($template->isSearch()): ?>
		<p class="search">
			スポット検索：<input type="text" value="" id="<?php echo $template->getId(); ?>_search" class="middle">
			<a href="javascript:void(0);" class="btn" onclick="<?php echo "obj_" . $template->getId(); ?>.setSoptSearch(document.getElementById('<?php echo $template->getId(); ?>_search').value);return false;">
				<i class="icon-search"></i>検索する
			</a>
		</p>
		<?php endif; ?>
	</div>
	座標：<input type="text" name="<?php echo $template->getName(); ?>[latlng]" value="<?php echo $template->getValue()["latlng"]; ?>" id="<?php echo $template->getId(); ?>_point" class="middle" />
	ズーム：<input type="text" name="<?php echo $template->getName(); ?>[zoom]" value="<?php echo $template->getValue()["zoom"]; ?>" id="<?php echo $template->getId(); ?>_zoom" class="short" />
</div>
<?php include THREES__APP_ROOT_DIR . "/app/Resources/views/admin/BlockTemplates/template_footer.php" ?>
<?php
$content_js["file"]["gmap_api"] = '<script src="https://maps.google.com/maps/api/js?key=AIzaSyABerZT0d92NIZ2Y70q5x-ZK3gIxoGHDmU"></script>';
$content_js["file"]["googlemap"] = '<script src="' . THREES__WEB_ROOT_PATH . 'admin/js/googlemap.js"></script>';

$content_js["raw"][] = <<<"EOT"
		initMap();
EOT;

if(empty($template->getValue()["latlng"])) {
	//初期位置
	$latlng = "34.98594365967241,135.75983594418028";
	$zoom = "14";	
}else{
	$latlng = $template->getValue()["latlng"];
	$zoom = $template->getValue()["zoom"];	
}



$content_js["raw"][] = <<<"EOT"
		
		function initMap() {
			//初期化
			zoomLevel = {$zoom};
			centerPos = new google.maps.LatLng({$latlng});
				
			obj_{$template->getId()} = new googlemap("{$template->getId()}_disp", "{$template->getId()}_point", "{$template->getId()}_zoom");
			$(function(){ obj_{$template->getId()}.setMap(); });
		}
	
EOT;
