jQuery(document).ready(function($){
	
	$( "#page_template" ).change(function(){
		windTemplate( $(this).val() );
	});

	function windTemplate( template ){
		$( "#wind-page-meta" ).hide();

		if ( 'pages/portfolio.php' == template
			|| 'pages/blog-summary.php' == template
			|| 'pages/portfolio-ajax.php' == template
			) {
			$( "#p_wind_category" ).show();
			$( "#p_wind_postperpage" ).show();
			$( "#p_wind_sidebar" ).show();
			$( "#p_wind_column" ).show();
			$( "#p_wind_thumbnail" ).show();
			$( "#p_wind_intro" ).show();
			$( "#p_wind_disp_meta" ).show();

			$( "#wind-page-meta" ).show();
		}
		else if ( 'pages/blog.php' == template ) {
			$( "#p_wind_category" ).show();
			$( "#p_wind_postperpage" ).show();
			$( "#p_wind_sidebar" ).show();
			$( "#p_wind_column" ).hide();
			$( "#p_wind_thumbnail" ).hide();
			$( "#p_wind_intro" ).hide();
			$( "#p_wind_disp_meta" ).hide();

			$( "#wind-page-meta" ).show();
		}
	}
	
	windTemplate( $( "#page_template" ).val() );
});
