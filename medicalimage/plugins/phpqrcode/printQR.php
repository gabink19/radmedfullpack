<!DOCTYPE html>
<html>
<head>
	<title>PRINT QR</title>
</head>
<body>
 
	<div class="tab-pane file-details-sharing-code active" id="printQR" style="text-align: center;">
        <h4 style="text-align: center;"><strong>QR Code</strong></h4><br>
        <img width="200" height="200" class="img-rounded" alt="/plugins/phpqrcode/qrcode/<?= $_GET['id'];?>.png" src="/plugins/phpqrcode/qrcode/<?= $_GET['id'];?>.png">
   	</div>
 
	<script>
		window.print();
	</script>
	
</body>
</html>