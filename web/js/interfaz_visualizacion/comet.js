
	var Comet = Class.create();
	Comet.prototype = {

	  timestamp: 0,
	  url: 'interfaz_visualizacion/publicarMensaje',
	  noerror: true,

	  initialize: function() { },

	  connect: function()
	  {
		this.ajax = new Ajax.Request(this.url, {
		  method: 'get',
		  parameters: { 'timestamp' : this.timestamp },
		  onSuccess: function(transport) {
			// handle the server response
			var response = transport.responseText.evalJSON();
			this.comet.timestamp = response['timestamp'];
			this.comet.handleResponse(response);
			this.comet.noerror = true;
		  },
		  onComplete: function(transport) {
			// send a new ajax request when this request is finished
			if (!this.comet.noerror)
			  // if a connection problem occurs, try to reconnect each 5 seconds
			  setTimeout(function(){ comet.connect() }, 5000); 
			else
			  this.comet.connect();
			this.comet.noerror = false;
		  }
		});
		this.ajax.comet = this;
	  },

	  disconnect: function()
	  {
	  },

	  handleResponse: function(response)
	  {
		Ext.getCmp('interfaz_visualizacion_mensaje_htmleditor').setValue(response['msg']);
	  },

	  doRequest: function(request)
	  {
		new Ajax.Request(this.url, {
		  method: 'get',
		  parameters: { 'msg' : request }
		});
	  }
	}