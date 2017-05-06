<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Duplicates remover</title>
<script src="../js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
function test(text) {
	var conf = document.getElementById('conf').value;
	var spin = $('#spin').is(':checked');
	var links = $('#links').is(':checked');
	var db1 = $('#db1').is(':checked');
	var sitemap = $('#sitemap').is(':checked');
	$.ajax({
		  url: "key_glue_.php",
		  type: 'POST',
		  data: {
			  'content': conf,
			  'spin': spin,
			  'links': links,
			  'db1': db1
          }
		}).done(function (response) {
			$('#temp').html(response);
		});					
}
</script>
</head>
<body>
<table>
	<tr>
		<td>
			<textarea rows="20" cols="70" id="conf"></textarea><br><br>
			<input id="spin" type="checkbox">&nbsp;Spin&nbsp;&nbsp;<input id="links" type="checkbox">&nbsp;Links&nbsp;&nbsp;<input id="db1" type="checkbox">&nbsp;DB1
			&nbsp;&nbsp;<input id="sitemap" type="checkbox">&nbsp;Sitemap<br>
			<input type="button" value="Glue keys" onclick="test();">
		</td>
	</tr>
</table><br>
<div id="temp"></div>
</body>
</html>