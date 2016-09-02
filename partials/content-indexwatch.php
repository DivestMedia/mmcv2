<?php



$_datas = stockMarket::request(array('AAPL','GOOG','YHOO','NDAQ'));


print_r($_datas);

?>
<section class="dark nopadding noborder" id="scroll-market">
		<div class="container black-bg border-bottom">
			<div class="row liner-bottom">
				<div class="col-sm-12 col-md-3 padding-10 nomargin">
					<small class="uppercase primary-color block nomargin">Index Watch</small>
					<span class="uppercase size-18 font-proxima nopadding nomargin">Stock Market</span>

				</div>
				<div class="col-sm-12 col-md-9 nopadding nomargin primary-bg noborder trading-graph">
					
					
					
					
					<div class="row box-gradient box-black noborder nopadding primary-bg">
						<div class="col-xs-6 col-sm-3 padding-10">
							
							<div class="text-center pull-left">
								<a href="#">S&P 500</a><br>
								<span class="text-white">2,172.47</span>
							</div>
							<div class="text-center width-40 pull-right">
								<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
									1,3,1,-1,0,2,1
								</span>
							</div>
						</div>
						<div class="col-xs-6 col-sm-3 padding-10">
							
							<div class="text-center pull-left">
								<a href="#">Nasdaq</a><br>
								<span class="text-white">5,212.20</span>
							</div>
							<div class="text-center width-40 pull-right">
								<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
									-1,1,0,-2,3,1,2
								</span>
							</div>
						</div>
						<div class="col-xs-6 col-sm-3 padding-10">
							
							<div class="text-center pull-left">
								<a href="#">GOOGL</a><br>
								<span class="text-white">4,676.80</span>
							</div>
							<div class="text-center width-40 pull-right">
								<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
									1,3,1,-1,0,2,1
								</span>
							</div>
						</div>
						<div class="col-xs-6 col-sm-3 padding-10">
							
							<div class="text-center pull-left">
								<a href="#">APPL</a><br>
								<span class="text-white">12,172.47</span>
							</div>
							<div class="text-center width-40 pull-right">
								<span class="sparkline" data-plugin-options='{"type":"bar","barColor":"#ffffff","height":"35px","width":"100%","zeroAxis":"false","barSpacing":"2"}'>
									1,-1,1,3,0,2,-1
								</span>
							</div>
						</div>
						

						
					</div>

					
				</div>
				
			</div>
				
		
		</div>
	</section>