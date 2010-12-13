<div id="div_form_interfaz_visualizacion"></div>
<?php echo javascript_include_tag('mediaplayer/swfobject.js') ?>
<?php echo javascript_include_tag('interfaz_visualizacion/form_interfaz_visualizacion.js') ?>
<div id='interfaz_visualizacion_canciones_panel_html'></div>

<script type='text/javascript'>
	  var so = new SWFObject('mediaplayer/player.swf','mpl','470','300','9');
	  so.addParam('allowfullscreen','false');
	  so.addParam('allowscriptaccess','always');
	  so.addParam('wmode','opaque');
	  so.addVariable('playlistfile','http://localhost/oms/web/prueba_podcasting3.xml');
	  //so.addVariable('file','http://localhost/oms/web/images/oms_orig.jpg');
	  //so.addVariable('image','http://localhost/oms/web/images/oms_orig.png');
	  //so.addVariable('playlistsize', '300');
	  so.addVariable('skin','mediaplayer/skins/Snel.swf');
	  so.addVariable('playlist','top');
	  so.write('div_form_interfaz_visualizacion');
	</script>