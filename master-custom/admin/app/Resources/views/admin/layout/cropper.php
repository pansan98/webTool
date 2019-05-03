<!-- image cropping -->
<style>
	.img-container {
		/*text-align: center;*/
		margin:auto;
		max-width: 90%;
		max-height: 500px;
	}
	.cropper-view-box {
		display: block;
		overflow: hidden;
		width: 100%;
		height: 100%;
		outline: 3px solid #1c2023;
		outline-color: #EFA71C;
	}
	.btn-group {
		margin:0px 0px 5px 0px; 
	}
	div.btn-group button {
		font-size:1.1em;
	}
	span.fix {
		width: 12px;
		height: 12px;
	}
	.navi {
		display:table;
		table-layout:fixed;
		width:100%;
		text-align:center;
	}

	ul.navi > li {
		display:table-cell;
		vertical-align:middle;
	}
</style>
<div class="container cropper" style="padding-top:10px;padding-bottom: 10px;">

	<div class="row" style="padding:10px 0px;">
		<div class="col-md-12">
			<div class="img-container">
				<img id="image" src="">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 docs-buttons" style="text-align: center;">

			<table style="border:0px!important;margin:auto;">
				<tr>
					<td style="padding:0px;border:0px!important;">
						<div class="btn-group">
							<table style="border:0px!important;">
								<tr>
									<td style="padding:0px;border:0px!important;">
										<button type="button" class="btn btn-primary" data-method="zoom" data-option="0.01" title="Zoom In">
											<span>
												<span class="fix fa fa-search-plus"></span>
											</span>
										</button>
									</td>
								</tr>
								<tr>
									<td style="padding:0px;border:0px!important;">
										<button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.01" title="Zoom Out">
											<span>
												<span class="fix fa fa-search-minus"></span>
											</span>
										</button>
									</td>
								</tr>
							</table>
						</div>
					</td>
					<td style="padding:0px;border:0px!important;">
						<div class="btn-group">
							<table style="border:0px!important;">
								<tr>
									<td style="padding:0px;border:0px!important;">
										<button type="button" class="btn btn-primary" data-method="rotate" data-option="-3" title="Rotate Left">
											<span class="docs-tooltip" data-toggle="tooltip" title="左回転">
												<span class="fix fa fa-rotate-left"></span>
											</span>
										</button>
									</td>
								</tr>
								<tr>
									<td style="padding:0px;border:0px!important;">
										<button type="button" class="btn btn-primary" data-method="rotate" data-option="3" title="Rotate Right">
											<span class="docs-tooltip" data-toggle="tooltip" title="右回転">
												<span class="fix fa fa-rotate-right"></span>
											</span>
										</button>
									</td>
								</tr>
							</table>
						</div>
					</td>
					<td style="padding:0px;border:0px!important;">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
								<span class="docs-tooltip" data-toggle="tooltip" title="左右反転">
									<span class="fix fa fa-arrows-h"></span>
								</span>
							</button>
							<button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
								<span class="docs-tooltip" data-toggle="tooltip" title="上下反転">
									<span class="fix fa fa-arrows-v"></span>
								</span>
							</button>
						</div>
					</td>
					<td style="padding:0px;border:0px!important;">
						<div class="btn-group">
							<table style="border:0px!important;">
								<tr>
									<td rowspan="2" style="padding:0px;border:0px!important;">
										<button type="button" class="btn btn-primary" data-method="move" data-option="-1" data-second-option="0" title="Move Left">
											<span>
												<span class="fix fa fa-arrow-left"></span>
											</span>
										</button>
									</td>
									<td style="padding:0px;border:0px!important;">
										<button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-1" title="Move Up">
											<span>
												<span class="fix fa fa-arrow-up"></span>
											</span>
										</button>
									</td>
									<td rowspan="2" style="padding:0px;border:0px!important;">
										<button type="button" class="btn btn-primary" data-method="move" data-option="1" data-second-option="0" title="Move Right">
											<span>
												<span class="fix fa fa-arrow-right"></span>
											</span>
										</button>
									</td>
								</tr>
								<tr>
									<td style="padding:0px;border:0px!important;">
										<button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="1" title="Move Down">
											<span>
												<span class="fix fa fa-arrow-down"></span>
											</span>
										</button>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>

		</div>
		<!-- /.docs-buttons -->
	</div>
</div>
<div class="" style="
	 width: 100%;
	 height: 50px;
	 background-color: #f1f1f1;
	 border-top: 1px solid #b5aeae;
	 padding: 5px;
	 -webkit-overflow-scrolling:touch;">
	<div class="col-md-12 docs-buttons">

		<div class="col-xs-6" style="text-align:center;">
			<button type="button" class="btn btn-warning" data-method="reset" title="Reset">
				<span class="docs-tooltip" data-toggle="tooltip" title="編集前に戻す" style="font-size:1.3em">
					<span class="fa fa-refresh"> 元に戻す</span>
				</span>
			</button>
		</div>

		<div class="btn-group-crop col-xs-6" style="text-align:center;">
			<button type="button" class="btn btn-success" data-method="getCroppedCanvas" title="Set">
				<span class="docs-tooltip" data-toggle="tooltip" title="編集を確定" style="font-size:1.3em">
					<span class="fa fa-check"> 編集確定</span>
				</span>
			</button>
		</div>
	</div>

</div>
<?php
/*
  <div class="row" style="padding:30px 0px">
  <div class="col-md-12">
  <!--
  <div class="docs-preview clearfix">
  <div class="img-preview preview-lg"></div>
  <div class="img-preview preview-md"></div>
  <div class="img-preview preview-sm"></div>
  <div class="img-preview preview-xs"></div>
  </div>
  -->

  <div class="docs-data">
  <div class="input-group input-group-sm">
  <label class="input-group-addon" for="dataX">X</label>
  <input type="text" class="form-control" id="dataX" placeholder="x">
  <span class="input-group-addon">px</span>
  </div>
  <div class="input-group input-group-sm">
  <label class="input-group-addon" for="dataY">Y</label>
  <input type="text" class="form-control" id="dataY" placeholder="y">
  <span class="input-group-addon">px</span>
  </div>
  <div class="input-group input-group-sm">
  <label class="input-group-addon" for="dataWidth">Width</label>
  <input type="text" class="form-control" id="dataWidth" placeholder="width">
  <span class="input-group-addon">px</span>
  </div>
  <div class="input-group input-group-sm">
  <label class="input-group-addon" for="dataHeight">Height</label>
  <input type="text" class="form-control" id="dataHeight" placeholder="height">
  <span class="input-group-addon">px</span>
  </div>
  <div class="input-group input-group-sm">
  <label class="input-group-addon" for="dataRotate">Rotate</label>
  <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
  <span class="input-group-addon">deg</span>
  </div>
  <div class="input-group input-group-sm">
  <label class="input-group-addon" for="dataScaleX">ScaleX</label>
  <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
  </div>
  <div class="input-group input-group-sm">
  <label class="input-group-addon" for="dataScaleY">ScaleY</label>
  <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
  </div>
  </div>
  </div>
  </div>
 */
?>

<!-- /image cropping -->
<?php
$content_js["raw"][] = <<<"EOT"
		
    
EOT;
