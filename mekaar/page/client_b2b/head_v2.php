<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<title>BiRU</title>

	<!--=== CSS ===-->

	<!-- Bootstrap -->
	<link href="<?=getUrlServer()?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=getUrlServer()?>/bootstrap/css/v4-margin-padding-bootstrap.min.css" rel="stylesheet" type="text/css" />
	
	<!-- jQuery UI -->
	<!--<link href="plugins/jquery-ui/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />-->
	<!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="plugins/jquery-ui/jquery.ui.1.10.2.ie.css"/>
	<![endif]-->

	<!-- Theme -->
	<link href="<?=getUrlServer()?>/assets/css/main_v2.css" rel="stylesheet" type="text/css" />
	<link href="<?=getUrlServer()?>/assets/css/plugins.css" rel="stylesheet" type="text/css" />
	<link href="<?=getUrlServer()?>/assets/css/responsive.css" rel="stylesheet" type="text/css" />
	<link href="<?=getUrlServer()?>/assets/css/icons.css" rel="stylesheet" type="text/css" />

	<link href="<?=getUrlServer()?>/assets/css/fontawesome/font-awesome.min.css" rel="stylesheet">
	<!--[if IE 7]>
		<link rel="stylesheet" href="assets/css/fontawesome/font-awesome-ie7.min.css">
	<![endif]-->

	<!--[if IE 8]>
		<link href="assets/css/ie8.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!-- link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css' -->

	<!--=== JavaScript ===-->

	<script type="text/javascript" src="<?=getUrlServer()?>/assets/js/libs/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>

	<script type="text/javascript" src="<?=getUrlServer()?>/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/assets/js/libs/lodash.compat.min.js"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="assets/js/libs/html5shiv.js"></script>
	<![endif]-->
	<!-- Forms -->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/uniform/jquery.uniform.min.js"></script> <!-- Styled radio and checkboxes -->

	<!-- Smartphone Touch Events -->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/event.swipe/jquery.event.move.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/event.swipe/jquery.event.swipe.js"></script>

	<!-- General -->
	<script type="text/javascript" src="<?=getUrlServer()?>/assets/js/libs/breakpoints.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/respond/respond.min.js"></script> <!-- Polyfill for min/max-width CSS3 Media Queries (only for IE8) -->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/cookie/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/slimscroll/jquery.slimscroll.horizontal.min.js"></script>

	<!-- DataTables -->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/datatables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/datatables/DT_bootstrap.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/datatables/responsive/datatables.responsive.js"></script> <!-- optional -->

	<!-- Page specific plugins -->
	<!-- Charts -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="plugins/flot/excanvas.min.js"></script>
	<![endif]-->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/sparkline/jquery.sparkline.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/flot/jquery.flot.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/flot/jquery.flot.tooltip.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/flot/jquery.flot.resize.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/flot/jquery.flot.time.min.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/flot/jquery.flot.growraf.min.js"></script>

	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/scrollto/jquery.scrollTo.min.js"></script>

	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/moment/moment-with-locales.js"></script>
	<!--script-- type="text/javascript" src="<?=getUrlServer()?>/plugins/daterangepicker/moment.min.js"></!--script-->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/blockui/jquery.blockUI.min.js"></script>

	<!-- Noty -->
	<script type="text/javascript" src="<?=getUrlServer()?>/plugins/noty/noty.min.js"></script>
	<link href="<?=getUrlServer()?>/plugins/noty/noty.css" rel="stylesheet">

	<!-- App -->
	<script type="text/javascript" src="<?=getUrlServer()?>/assets/js/app.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/assets/js/plugins.js"></script>
	<script type="text/javascript" src="<?=getUrlServer()?>/assets/js/plugins.form-components.js"></script>

	<script>
		function formatNumber(amount) {
			let num=parseFloat(amount.replace(/[\$,]/g, ''));
			return !isNaN(num)?num:null;
		}
		function formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
			try {
				decimalCount = Math.abs(decimalCount);
				decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

				const negativeSign = amount < 0 ? "-" : "";

				let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
				let j = (i.length > 3) ? i.length % 3 : 0;

				return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
			} catch (e) {
				console.log(e)
			}
		}
		function htmlDecode(input){
			var e = document.createElement('textarea');
			e.innerHTML = input;
			// handle case of empty input
			return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
		}
		function logging_result(x){//acept json/obj
			x=JSON.stringify(x);
			$.ajax({
				url : "<?=getUrlServer()?>/log_result.php",
				data: {x:x},
				type: "post",
				dataType:"text",
				success:function(result){
					console.log(result);
				},
				error: function(xhr, Status, err) {
						console.log("Terjadi error logging result : "+Status+err+" : ");
				}
			});
		}
		function setCookie(cname, cvalue, exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
			var expires = "expires="+d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}
		function deleteCookie(cname){
			document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
		}
		function getCookie(cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
				c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
				}
			}
			return "";
		}
		$(document).ready(function(){
			"use strict";
			App.init(); // Init layout and core plugins
			Plugins.init(); // Init all plugins
			FormComponents.init(); // Init all form-specific plugins
			$('[data-toggle="popover"]').popover({
				trigger: 'hover'
			});
			$('.money').each(function(index,data){
				data.innerHTML = formatMoney(parseFloat(data.innerHTML),2,',','.');
			});
		});
	</script>

	<!-- Demo JS -->
	<script type="text/javascript" src="<?=getUrlServer()?>/assets/js/custom.js"></script>
	<!--script-- type="text/javascript" src="assets/js/demo/charts/chart_filled_yellow.js"></!--script-->


</head>

