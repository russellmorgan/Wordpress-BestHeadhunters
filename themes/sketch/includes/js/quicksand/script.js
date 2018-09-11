jQuery.noConflict();
jQuery(document).ready(function($){
 	// Clone applications to get a second collection
	var $data = J(".filter-posts").clone();
	
	J('.filter-list li').click(function(e) {
		J(".filter li").removeClass("active");	
		// Use the last category class as the category to filter by.
		var filterClass=J(this).attr('class').split(' ').slice(-1)[0];
		
		if (filterClass == 'all-projects') {
			var $filteredData = $data.find('.project');
		} else {
			var $filteredData = $data.find('.project[data-type~=' + filterClass + ']');
		}
		J(".filter-posts").quicksand($filteredData, {
			duration: 400,
			easing: 'jswing',
			adjustHeight: 'auto',
		});		
		J(this).addClass("active"); 			
		return false;
	});
});