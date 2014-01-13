		var xmlDoc;
		var arrayTiendas;
		var tiendas = [];
			function loadXMLDoc(dname) {
				if (window.XMLHttpRequest) {
					xhttp=new XMLHttpRequest();
				} else {
					xhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xhttp.open("GET",dname,false);
				xhttp.send();
				return xhttp.responseXML;
			}
			
			function xml2json (array) {
				for (i=0;i<array.length;i++)
					{
				if (typeof(array[i]) != 'undefined') {
				var nombre = array[i].getElementsByTagName("nombre")[0].childNodes[0].nodeValue;
				var rubro = array[i].getElementsByTagName("categorias")[0].childNodes[0].nodeValue;
				rubro = rubro.split(',');
				if (typeof(array[i].getElementsByTagName("tags")[0].childNodes[0]) != 'undefined') { var productos = array[i].getElementsByTagName("tags")[0].childNodes[0].nodeValue; }
				if (typeof productos=='string') { productos = productos.split(','); }				
				if (!array[i].getElementsByTagName("referencia_plano")[0].childNodes[0]) { var nodo = 0; } else { var nodo = array[i].getElementsByTagName("referencia_plano")[0].childNodes[0].nodeValue; }
				if (typeof(array[i].getElementsByTagName("logo")[0].childNodes[0].nodeValue) != 'undefined') { var logo = array[i].getElementsByTagName("logo")[0].childNodes[0].nodeValue; }
				logo = encodeURI(logo);
				if (typeof(array[i].getElementsByTagName("piso")[0].childNodes[0].nodeValue) != 'undefined') { var piso = array[i].getElementsByTagName("piso")[0].childNodes[0].nodeValue; }
				if (typeof(array[i].getElementsByTagName("sector")[0].childNodes[0]) != 'undefined') { var area = array[i].getElementsByTagName("sector")[0].childNodes[0].nodeValue; }
				tiendas.push({
						nombre: nombre,
						nodo: nodo,
						logo: logo,
						rubro: rubro,
						productos: productos,
						piso: piso,
						area: area
							});
					}
					}
			}
			
			function sortOn(property){
			return function(a, b){
				if(a[property] < b[property]){
				return -1;
				}else if(a[property] > b[property]){
				return 1;
				}else{
				return 0;   
				}
				}
			}
			
			function listaRubros(array) {
					var arrayTemp = [];
					for (i=0;i<array.length;i++)
					{
					arrayTemp.push(array[i].rubro[0]);
					if (typeof(array[i].rubro[1]) != 'undefined') { arrayTemp.push(array[i].rubro[1]); }
					}
					arrayTemp = eliminateDuplicates(arrayTemp);
					return arrayTemp;
					}
			
			function htmlListaTiendas(array, id) {
				var html = document.getElementById('thelist');
				for (j=0;j<array.length;j++)
				if ((typeof(array[j]) != 'undefined') && array[j].nodo != 0) {
				{
				var stringFuncion = "cargaPagina(" + array[j].nodo + "," + array[j].nodo + "," + array[j].piso + ",\"" + array[j].nombre + "\",\"" + array[j].logo + "\")";
				html.innerHTML  += "<li><a class='mapa fancybox.iframe' onClick='" + stringFuncion + "'><img src=" + array[j].logo + " width='120' height='100'></a><div class='nombre-tienda'><p class='texto-lista'><a class='mapa fancybox.iframe' name=" + array[j].nombre + "</a>" + array[j].nombre + "</p><p class='subtexto-lista'>Nivel " + array[j].piso + "</p></div><a class='button-mapa mapa fancybox.iframe' onClick='" + stringFuncion + "'></a></li>";
				}
				}
				}

			function htmlListaRubros(array) {
				var div_resultadosRubros = document.getElementById('resultadosRubros');
				var arrayListaRubros = [];
				arrayListaRubros = listaRubros(array);
				for (k=0;k<arrayListaRubros.length;k++)
					{
					var stringFuncion = "listaTiendasPorRubro(\"" + arrayListaRubros[k] + "\");";
					div_resultadosRubros.innerHTML +="<li><div class='nombre-tienda'><p class='texto-lista'><a onClick='" + stringFuncion + "'>" + arrayListaRubros[k] + "</a></p></div><a onClick='" + stringFuncion + "' class='button-mapa button-rubros'></a></li>";
					}
			}
			
			function busquedaLetra(array,letra) {
			var arrayTemp = [];
			for (i=0;i<array.length;i++)
					{
					var letraNombre = array[i].nombre;
					var letraNombre = letraNombre.substring(0,1);
					if (letraNombre == letra) {
						arrayTemp.push(array[i]);
					}
					}
			return arrayTemp;
			}
			
			function buscarTiendaPorNombre(array,nombre) {
			var arrayTemp = [];
			for (i=0;i<array.length;i++)
					{
					var nombreTemp = array[i].nombre;
					if (nombreTemp == nombre) {
						arrayTemp.push(array[i]);
					}
					}
			return arrayTemp;
			}
			
			function tiendasPorArea(array,area) {
			var arrayTemp = [];
			for (i=0;i<array.length;i++)
					{
					var areaTemp = array[i].area;
					if (areaTemp == area) {
						arrayTemp.push(array[i]);
					}
					}
			return arrayTemp;
			}
			
			function busquedaRubro(array,rubro) {
			var arrayTemp = [];
			for (i=0;i<array.length;i++)
					{
					var stringRubro = array[i].rubro;
					if ((stringRubro[0] == rubro) && (stringRubro[1] == rubro)) {
						arrayTemp.push(array[i]);
					}
					}
			}
			function busquedaProducto(array,producto) {
			var arrayTemp = [];
			for (i=0;i<array.length;i++)
					{
					var stringProducto = array[i].productos;
					if ((stringProducto[0] == producto) || (stringProducto[1] == producto) || (stringProducto[2] == producto) || (stringProducto[3] == producto) || (stringProducto[4] == producto) || (stringProducto[5] == producto)) {
						arrayTemp.push(array[i]);
					}
					}
			return arrayTemp;
			}
			
			function checkRubro(array,rubro) {
					var flag = new Boolean();
					var arrayTemporal = [];
					for (i=0;i<array.length;i++)
					{
						if ((array[i].rubro[0]) == rubro || (array[i].rubro[1] == rubro)) { flag: true; arrayTemporal.push(array[i]); }
					}
					return [flag, arrayTemporal];
					}
					
			function eliminateDuplicates(arr) {
			var i,
			len=arr.length,
			out=[],
			obj={};
				for (i=0;i<len;i++) {
					obj[arr[i]]=0;
				}
				for (i in obj) {
				out.push(i);
				}
				return out;
			}
			
			function cargaPagina(ubicacion,idTienda,piso,nombre,logo)
				{
				$.fancybox({
				type		: "iframe",
				fitToView	: true,
				width		: 900,
				height		: 1100,
				padding 	: 40,
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'fade',
				closeEffect	: 'elastic',
				openSpeed	: 'normal',
				helpers 	: { overlay : {opacity: 0.5, css : {'background-color' : '#440007'} } },
				href:"getCaminoMasCorto.php?inicio=263&meta="+ubicacion+"&idTienda="+idTienda+"&piso="+piso+"&nombre="+nombre+"&logo="+logo+""
				});
				}
			
		xmlDoc = loadXMLDoc("src/xml/tiendas.xml");
		arrayTiendas = Array.prototype.slice.call(xmlDoc.getElementsByTagName("tienda"));
		xml2json(arrayTiendas);
		//tiendas = JSON.stringify(tiendas, null, 4);