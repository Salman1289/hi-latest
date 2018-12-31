jQuery(function ($) {
	custom_admin_select();
	toggleonecourses();
	function custom_admin_select() {
		$('#customize-control-thim_logo_mobile').hide();
		$('#customize-control-thim_sticky_logo_mobile').hide();
		$('#customize-control-thim_config_logo_mobile select').on('change', function () {
			if ($(this).val() == "custom_logo") {
				$('#customize-control-thim_logo_mobile').show();
				$('#customize-control-thim_sticky_logo_mobile').show();
			} else {
				$('#customize-control-thim_logo_mobile').hide();
				$('#customize-control-thim_sticky_logo_mobile').hide();
			}
		}).trigger('change');
	}

	function toggleonecourses() {
		$('#page_template').change(function () {
			var elem = $(this).val();
			if( elem == 'page-templates/one-courses.php' ){
				$('#get-course').show();
				$('#display-setting').hide();
				$('#get-course-v1').hide();
			}else if( elem == 'page-templates/one-courses-v1.php' ){
				$('#get-course-v1').show();
				$('#display-setting').hide();
				$('#get-course').hide();
			}else if( elem == 'page-templates/homepage.php' ){
				$('#display-setting').show();
				$('#get-course-v1').hide();
				$('#get-course').hide();
			}else{
				$('#get-course').hide();
				$('#get-course-v1').hide();
			}
		}).trigger('change');
	}

	$("[name='thim_id_course']").chosen();
});