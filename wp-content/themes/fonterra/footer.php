<?php
/*
			<!-- footer -->
			<footer class="footer" role="contentinfo">

				<!-- copyright -->
				<p class="copyright">
					&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <?php _e('Powered by', 'html5blank'); ?>
					<a href="//wordpress.org" title="WordPress">WordPress</a> &amp; <a href="//html5blank.com" title="HTML5 Blank">HTML5 Blank</a>.
				</p>
				<!-- /copyright -->

			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->
*/
?>
		<?php wp_footer(); ?>
<?php
/*
		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>
*/
?>
	<script>
	// When the user clicks on div, open the popup
	function popupVimeo() {
		var $popup = $('#myPopup');
		$popup.toggleClass('show');
		if ($popup.hasClass('show')) {
			$popup.find('iframe')[0].src += "&autoplay=1";
		}else{
			$popup.find('iframe')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
		}
		// $("#myPopup iframe")[0].src += "&autoplay=1";
		// $('#myPopup').on('hidden.bs.modal', function (e) {
		// 	console.log(':)');
		// 	$('#myPopup iframe').get(0).stopVideo();
		// })
		// if (popup.classList.toggle("hide")) {
		// 	$("#myPopup iframe")[1].src += "&autoplay=0";
		// }
	}

	</script>
	</body>
</html>
