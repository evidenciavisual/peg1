<?php
//------------------------------------------------
// CARGA DE ARCHIVO XML
//------------------------------------------------
if (file_exists('src/xml/cine.xml')) {
	$file= file_get_contents('src/xml/cine.xml');

	
	
	//$file= str_replace("%0A", "", $file);
	$file= str_replace("
</afiche>", "</afiche>", $file);

	$file= str_replace("&iexcl;", "¡", $file);
	$file= str_replace("&lt;","<",$file);
	$file= str_replace("&gt;",">",$file);
	$file= str_replace("&aacute;","á",$file);
	$file= str_replace("&Aacute;","Á",$file);
	$file= str_replace("&eacute;","é",$file);
	$file= str_replace("&Eacute;","É",$file);
	$file= str_replace("&iacute;","í",$file);
	$file= str_replace("&Iacute;","Í",$file);
	$file= str_replace("&oacute;","ó",$file);
	$file= str_replace("&Oacute;","Ó",$file);
	$file= str_replace("&uacute;","ú",$file);
	$file= str_replace("&Uacute;","Ú",$file);
	$file= str_replace("&ntilde;","ñ",$file);
	$file= str_replace("&Ntilde;","Ñ",$file);
	$file= str_replace("&#153;","™",$file);
	$file= str_replace("&euro;","€",$file);
	$file= str_replace("&ccedil;","ç",$file);
	$file= str_replace("&Ccedil;","Ç",$file);
	$file= str_replace("&uuml;","ü",$file);
	$file= str_replace("&Uuml;","Ü",$file);
	$file= str_replace("&amp;","&",$file);
	$file= str_replace("&iquest;","¿",$file);
	$file= str_replace("&iexcl;","¡",$file);
	$file= str_replace("&quot;",'"',$file);
	$file= str_replace("&middot;","·",$file);
	$file= str_replace("&ordm;","º",$file);
	$file= str_replace("&ordf;","ª",$file);
	$file= str_replace("&not;","¬",$file);
	$file= str_replace("&copy;","©",$file);
	$file= str_replace("&reg;","®",$file);

	$file= str_replace("&ndash;", "–", $file);
	$file= str_replace("&ntilde;", "ñ", $file);
	$file= str_replace("&hellip;", "…", $file);
	$file= str_replace("&ldquo;", "“", $file);
	$file= str_replace("&rdquo;", "”", $file);
	$file= str_replace("&rsquo;", "’", $file);
	$file= str_replace("&lsquo;","‘",$file); 
	$file= str_replace("&mdash", "—", $file);
	$file= str_replace("&nbsp;", " ", $file);

	$file= str_replace("&AElig;","Æ",$file);
	$file= str_replace("&Agrave;","À",$file);
	$file= str_replace("&Auml;","Ä",$file);
	$file= str_replace("&Eacute;","É",$file);
	$file= str_replace("&Euml;","Ë",$file);
	$file= str_replace("&Igrave;","Ì",$file);
	$file= str_replace("&Oacute;","Ó",$file);
	$file= str_replace("&Oslash;","Ø ",$file);
	$file= str_replace("&Ugrave;","Ù",$file);
	$file= str_replace("&aacute;","á",$file);
	$file= str_replace("&agrave;","à",$file);
	$file= str_replace("&auml;","ä",$file);
	$file= str_replace("&ecirc;","ê",$file);
	$file= str_replace("&euml;","ë",$file);
	$file= str_replace("&igrave;","ì",$file);
	$file= str_replace("&oacute;","ó",$file);
	$file= str_replace("&oslash;","ø",$file);
	$file= str_replace("&szlig;","ß",$file);
	$file= str_replace("&ucirc;","û",$file);
	$file= str_replace("&yacute;","ý",$file);
	$file= str_replace("&Acirc;","Â",$file);
	$file= str_replace("&Aacute;","Á",$file);
	$file= str_replace("&Aring;","Å",$file);
	$file= str_replace("&Ccedil;","Ç",$file);
	$file= str_replace("&Ecirc;","Ê",$file);
	$file= str_replace("&Iacute;","Í",$file);
	$file= str_replace("&Iuml;","Ï",$file);
	$file= str_replace("&Ocirc;","Ô",$file);
	$file= str_replace("&Otilde;","Õ",$file);
	$file= str_replace("&Uacute;","Ú",$file);
	$file= str_replace("&Uuml;","Ü",$file);
	$file= str_replace("&acirc;","â",$file);
	$file= str_replace("&aring;","å",$file);
	$file= str_replace("&ccedil;","ç",$file);
	$file= str_replace("&egrave;","è",$file);
	$file= str_replace("&iacute;","í",$file);
	$file= str_replace("&iuml;","ï",$file);
	$file= str_replace("&ocirc;","ô",$file);
	$file= str_replace("&otilde;","õ",$file);
	$file= str_replace("&thorn;","þ",$file);
	$file= str_replace("&ugrave;","ù",$file);
	$file= str_replace("&yuml; ","ÿ	",$file);
	$file= str_replace("&Atilde;","Ã",$file);
	$file= str_replace("&ETH;","Ð",$file);
	$file= str_replace("&Egrave;","È",$file);
	$file= str_replace("&Icirc;","Î",$file);
	$file= str_replace("&Ntilde;","Ñ",$file);
	$file= str_replace("&Ograve;","Ò",$file);
	$file= str_replace("&Ouml;","Ö",$file);
	$file= str_replace("&Ucirc;","Û",$file);
	$file= str_replace("&Yacute;","Ý",$file);
	$file= str_replace("&aelig;","æ",$file);
	$file= str_replace("&atilde;","ã",$file);
	$file= str_replace("&eacute;","é",$file);
	$file= str_replace("&eth;","ð",$file);
	$file= str_replace("&icirc;","î",$file);
	$file= str_replace("&ntilde;","ñ",$file);
	$file= str_replace("&ograve;","ò",$file);
	$file= str_replace("&ouml;","ö",$file);
	$file= str_replace("&uacute;","ú",$file);
	$file= str_replace("&uuml;","ü",$file);

	$file= str_replace("&curren;","¤",$file);
	$file= str_replace("&sect;","§",$file);
	$file= str_replace("&ordf;","ª",$file);
	$file= str_replace("&shy;","­",$file);
	$file= str_replace("&deg;","°",$file);
	$file= str_replace("&sup3;","³",$file);
	$file= str_replace("&para;","¶",$file);
	$file= str_replace("&sup1;","¹",$file);
	$file= str_replace("&frac14;","¼",$file);
	$file= str_replace("&iquest;","¿",$file);
	$file= str_replace("&brvbar;","¦",$file);
	$file= str_replace("&copy;","©",$file);
	$file= str_replace("&not;","¬",$file);
	$file= str_replace("&macr;","¯",$file);
	$file= str_replace("&sup2;","²",$file);
	$file= str_replace("&micro;","µ",$file);
	$file= str_replace("&cedil;","¸",$file);
	$file= str_replace("&raquo;","»",$file);
	$file= str_replace("&frac34;","¾",$file);
	$file= str_replace("&yen;","¥",$file);
	$file= str_replace("&uml;","¨",$file);
	$file= str_replace("&laquo;","«",$file);
	$file= str_replace("&reg;","®",$file);
	$file= str_replace("&plusmn;","±",$file);
	$file= str_replace("&acute;","´",$file);
	$file= str_replace("&middot;","·",$file);
	$file= str_replace("&ordm;","º",$file);
	$file= str_replace("&frac12;","½",$file);
	$file= str_replace("&#13;", " ", $file);

	/*
	
	
	$file= str_replace("&ldquo;", "“", $file);
	$file= str_replace("&rdquo;", "”", $file);
	$file= str_replace("&lsquo;","‘",$file);  
	$file= str_replace("&rsquo;", "’", $file);
	$file= str_replace("&ndash;", "–", $file);
	$file= str_replace("&ntilde;", "ñ", $file);
	$file= str_replace("&hellip;", "…", $file);
	$file= str_replace("&ldquo;", "“", $file);
	$file= str_replace("&rdquo;", "”", $file);
	$file= str_replace("&rsquo;", "’", $file);
	$file= str_replace("&lsquo;","‘",$file); */
	//$file= str_replace("%0A", "", $file);

	//file_put_contents("src/xml/cine2.xml", $file);

    $xml = simplexml_load_file('src/xml/cine.xml');
//------------------------------------------------
// FIN CARGA XML
//------------------------------------------------
    ?>

<!DOCTYPE html> 
<html> 
	<head> 
	    <meta charset="UTF-8" />
		<title>Mall Plaza</title> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
	</head> 
	

	<body> 
		<div data-role="page" id="cine" class="mall-inicio-bg">
		  	<script type="text/javascript">
				$('#cine').bind('pageshow', function(event, ui){
					var myScroll = new iScroll('wrapper-h-cine');
					/*---- ESTADISTICAS POR PAGINA------*/
					var ur = window.location.href;
					ur=ur.split("/");
					ur=ur[4].split(".");
					//alert(ur[0]);
					ur=ur[0];
					$.get("addEstadistica.php", { nomPag: ur } );
					/*---- ESTADISTICAS POR PAGINA------*/					
				});	
			</script>
			<script>
				function habilita(i)
				{
					$('#cajaCine'+i+"").slideToggle("slow");
				}
			</script>
						<div data-role="content">
			    <div class="titulos">
				    <div class="volver-btn">
				    	<span><a href="inicio.html" data-transition="slide" data-direction="reverse"></a></span>
				    </div>
				    <div class="titulo-txt">
				    	<h1>Cine</h1>
				    </div>
			    </div>
			<div style="text-align: center; margin-top: 10px;">
			<img src="src/img/imax.png" />
			</div>
			    </div>
		</div>
</div>
	</body>
</html>
<?php
} 
else {
    exit('Fallo al abrir XML.');
}
?>