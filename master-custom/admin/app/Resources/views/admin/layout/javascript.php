<?php { /* スコープ開始 */ ?>
    <script>
    // グローバル定数
    var BASE_URL = '<?php echo $view->escape($app->getRequest()->getBaseUrl()); ?>';
    var THREES__WEB_ROOT_PATH = '<?php echo $view->escape(THREES__WEB_ROOT_PATH);?>';
    var THREES__APP_PATH = '<?php echo $view->escape(THREES__APP_ROOT_DIR);?>';
    </script>
	<!-- jQuery -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo THREES__WEB_ROOT_PATH; ?>admin/js/custom.js"></script>

	<?php
	if (isset($content_js["file"])) :
		foreach ($content_js["file"] as $js):
			echo $js . PHP_EOL;
		endforeach;
	endif;
	?>

	<script>
		<?php
		if (isset($content_js["raw"])) :
			foreach ($content_js["raw"] as $js):
				echo $js . PHP_EOL;
			endforeach;
		endif;
		?>
		
		function modal_close() {
			$("body").css("position", "");
		}
		/*
		 base64 = $image.cropper('getCroppedCanvas').toDataURL("image/jpeg");
		  base64 = base64.replace(/^.*,/, '');
		 */
		var target_id;
		var target_width;
		var target_height;
		function init_cropper(obj, width, height, mode) {

			//bodyをfilexへ
			$("body").css("position", "fixed");
			
			target_obj = $(obj).closest('div.sort_box');
			//alert(target_obj[0].id);
		
			if (typeof ($.fn.cropper) === 'undefined') {
				return;
			}
			if ('undefined' === width) {
				width = 300;
			}
			if ('undefined' === height) {
				height = 300;
			}
			if ('undefined' === mode) {
				mode = "";
			}
			target_id = target_obj[0].id;
			target_width = width;
			target_height = height;
		
			var $image = $('#image');
			//var $download = $('#download');
			//var $dataX = $('#dataX');
			//var $dataY = $('#dataY');
			//var $dataHeight = $('#dataHeight');
			//var $dataWidth = $('#dataWidth');
			//var $dataRotate = $('#dataRotate');
			//var $dataScaleX = $('#dataScaleX');
			//var $dataScaleY = $('#dataScaleY');
			var options = {
				aspectRatio: width / height,
				dragMode: 'move',
				autoCropArea: 1,
				cropBoxMovable: false,
				cropBoxResizable: false,
				toggleDragModeOnDblclick: false,
				movable : true,
				//preview: '.img-preview',
				crop: function (e) {
					//$dataX.val(Math.round(e.x));
					//$dataY.val(Math.round(e.y));
					//$dataHeight.val(Math.round(e.height));
					//$dataWidth.val(Math.round(e.width));
					//$dataRotate.val(e.rotate);
					//$dataScaleX.val(e.scaleX);
					//$dataScaleY.val(e.scaleY);
				}
			};

			// Tooltip
			$('[data-toggle="tooltip"]').tooltip();

			// Cropper
			/*
			$image.on({
				'build.cropper': function (e) {
					console.log(e.type);
				},
				'built.cropper': function (e) {
					console.log(e.type);
				},
				'cropstart.cropper': function (e) {
					console.log(e.type, e.action);
				},
				'cropmove.cropper': function (e) {
					console.log(e.type, e.action);
				},
				'cropend.cropper': function (e) {
					console.log(e.type, e.action);
				},
				'crop.cropper': function (e) {
					console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
				},
				'zoom.cropper': function (e) {
					console.log(e.type, e.ratio);
				}
			}).cropper(options);
			*/

			// Buttons
			if (!$.isFunction(document.createElement('canvas').getContext)) {
				$('button[data-method="getCroppedCanvas"]').prop('disabled', true);
			}

			if (typeof document.createElement('cropper').style.transition === 'undefined') {
				$('button[data-method="rotate"]').prop('disabled', true);
				$('button[data-method="scale"]').prop('disabled', true);
			}

			// Download
			//if (typeof $download[0].download === 'undefined') {
			//	$download.addClass('disabled');
			//}

			// Options
			/*
			$('.docs-toggles').on('change', 'input', function () {
				var $this = $(this);
				var name = $this.attr('name');
				var type = $this.prop('type');
				var cropBoxData;
				var canvasData;

				if (!$image.data('cropper')) {
					return;
				}

				if (type === 'checkbox') {
					options[name] = $this.prop('checked');
					cropBoxData = $image.cropper('getCropBoxData');
					canvasData = $image.cropper('getCanvasData');

					options.built = function () {
						$image.cropper('setCropBoxData', cropBoxData);
						$image.cropper('setCanvasData', canvasData);
					};
				} else if (type === 'radio') {
					options[name] = $this.val();
				}

				$image.cropper('destroy').cropper(options);
			});
			*/
		    
			// Methods
			$('.docs-buttons').on('click', '[data-method]', function () {
				var $this = $(this);
				var data = $this.data();
				var $target;
				var result;

				if ($this.prop('disabled') || $this.hasClass('disabled')) {
					return;
				}

				if ($image.data('cropper') && data.method) {
					data = $.extend({}, data); // Clone a new one

					if (typeof data.target !== 'undefined') {
						$target = $(data.target);

						if (typeof data.option === 'undefined') {
							try {
								data.option = JSON.parse($target.val());
							} catch (e) {
								console.log(e.message);
							}
						}
					}

					result = $image.cropper(data.method, data.option, data.secondOption);
					
					switch (data.method) {
						case 'scaleX':
						case 'scaleY':
							$(this).data('option', -data.option);
							break;

						case 'getCroppedCanvas':
							//data.option = {"width": target_width, "height": target_height};
							//result = $image.cropper(data.method, data.option, data.secondOption);
							if (result) {
								mime = "image/jpeg";
								width = result.width;
								height = result.height;
								size = result.size;
								base64 = result.toDataURL(mime);
								blob = toBlob(base64, mime);
								filesize = blob["size"];
								
								$("#" + target_id + "_image").attr("src", base64);
								$("#" + target_id + "_filename").val("");
								$("#" + target_id + " span.filesize").html(filesize.toLocaleString());
								$("#" + target_id + " span.size_width").html(width);
								$("#" + target_id + " span.size_height").html(height);
								
								$("button.close-animatedModal").trigger("click");
								
								//Bootstrap's Modal
								//$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

								//if (!$download.hasClass('disabled')) {
								//	$download.attr('href', result.toDataURL());
								//}
							}

							break;
					}

					if ($.isPlainObject(result) && $target) {
						try {
							$target.val(JSON.stringify(result));
						} catch (e) {
							console.log(e.message);
						}
					}

				}
			});

			// Keyboard
			$(document.body).on('keydown', function (e) {
				if (!$image.data('cropper') || this.scrollTop > 300) {
					return;
				}

				switch (e.which) {
					case 37:
						e.preventDefault();
						$image.cropper('move', -1, 0);
						break;

					case 38:
						e.preventDefault();
						$image.cropper('move', 0, -1);
						break;

					case 39:
						e.preventDefault();
						$image.cropper('move', 1, 0);
						break;

					case 40:
						e.preventDefault();
						$image.cropper('move', 0, 1);
						break;
				}
			});

			// Import image
			/*
			var $inputImage = $('#inputImage');
			var URL = window.URL || window.webkitURL;
			var blobURL;
			if (URL) {
				$inputImage.change(function () {
					var files = this.files;
					var file;

					if (!$image.data('cropper')) {
						return;
					}

					if (files && files.length) {
						file = files[0];

						if (/^image\/\w+$/.test(file.type)) {
							blobURL = URL.createObjectURL(file);
							alert(blobURL);
							$image.one('built.cropper', function () {

								// Revoke when load complete
								URL.revokeObjectURL(blobURL);
							}).cropper('reset').cropper('replace', blobURL);
							$inputImage.val('');
						} else {
							window.alert('Please choose an image file.');
						}
					}
				});
			} else {
				$inputImage.prop('disabled', true).parent().addClass('disabled');
			}
			*/
		    var img = $('#'+target_obj[0].id+'_filename').val();
			if('undefined' === typeof img || "" === img){
				base64 = $('#'+target_obj[0].id+'_image').attr("src");
				var mime = base64.match(/data:(.*);base64/);
				blob = toBlob(base64, mime);
				var blobURL2 = window.URL.createObjectURL(blob);
				$image.cropper('destroy').cropper(options);
			    $image.cropper('reset').cropper('replace', blobURL2);
			}else{
				$image.cropper('destroy').cropper(options);
				$image.cropper('reset').cropper(options).cropper('replace', "/datas/" + img);
			}
		};
		

		$(function () {
		<?php
			if (isset($content_js["init"])) :
				foreach ($content_js["init"] as $js):
					echo $js . PHP_EOL;
				endforeach;
			endif;
		?>
		});
		$(window).on('load resize', function () {
			/*$("#left-sidebar-menu").height(window.innerHeight-50);*/
		});

	</script>

<?php
} /* スコープ終了 */
