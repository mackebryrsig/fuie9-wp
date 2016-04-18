(function(root, document, $) {
'use strict';
	var app = {
		init : function() {
			this.win = $(window);
			this.doc = $(document);
			this.body = $('body');
			
			for (var name in this) {
				if (typeof(this[name].init) === 'function') {
					this[name].init();
				}
			}

		},
		test_func : {
			init : function() {
				console.log('Test init!');
			}
		}
	};
	// publish
	root.app = app;
	// init
	$( root ).ready(function() {
		app.init();
	});
})(window, document, jQuery);