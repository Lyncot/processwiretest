<form method="post" class="nquire" id="nquireForm" action="">
	<div class="flex-grid grid-padding-x">
		<div class="cell small-12">
			<input type="text" placeholder="*Name" name="name" required />
		</div>
	</div>
	<div class="flex-grid grid-padding-x">
		<div class="cell small-12 medium-6">
			<input type="email" placeholder="*Email" name="email" required />
		</div>
		<div class="cell small-12 medium-6">
			<input type="phone" placeholder="Phone" name="phone" />
		</div>
	</div>
	<div class="flex-grid grid-padding-x">
		<div class="cell small-12">
			<input type="text" placeholder="Postcode" name="postcode" />
		</div>
	</div>
	<div class="flex-grid grid-padding-x">
		<div class="cell small-12">
			<textarea rows="5" name="message" placeholder="Message"></textarea>
		</div>
	</div>

	<div class="flex-grid grid-padding-x">
		<div class="cell small-12">
			<label class="tick-box">
				<input type="checkbox" name="newsletter" value="Opted In">
				Subscribe me to your newsletter
			</label>
		</div>
	</div>

	<div class="flex-grid grid-padding-x">
		<div class="cell small-12">
			<input type="hidden" name="honeypot">
			<button class="cta" onclick="nquire(event, '<?php echo $google_analytics_id; ?>')">Send Your Enquiry <i class="fal fa-arrow-circle-right"></i></button>
		</div>
	</div>

	<div class="qe-loading" id="qe-loading">
	    <div>
	    	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
	    	<circle cx="50" cy="50" fill="none" stroke="#000000" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138" transform="rotate(177.034 50 50)">
	    	<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="0.8s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
	    	</circle>
	    	</svg>
	    </div>
	    <span><strong>Submitting</strong></span>
    </div>
</form>