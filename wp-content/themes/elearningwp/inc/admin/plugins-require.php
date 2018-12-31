<?php

function thim_get_all_plugins_require( $plugins ) {
	return array(
		array(
			'name'     => 'eLearningWP Demo Data',
			'slug'     => 'elearningwp-demo-data',
			'premium'  => true,
			'required' => true,
		),
		array(
			'name'        => 'LearnPress',
			'slug'        => 'learnpress',
			'required'    => true,
			'version'     => '2.1.6',
			'description' => 'LearnPress is a WordPress complete solution for creating a Learning Management System (LMS). It can help you to create courses, lessons and quizzes. By ThimPress.',
		),
		array(
			'name'        => 'LearnPress - Coming Soon Courses',
			'slug'        => 'learnpress-coming-soon-courses',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.1',
			'description' => 'Set a course is "Coming Soon" and schedule to public',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress Certificates',
			'slug'        => 'learnpress-certificates',
			'premium'     => true,
			'required'    => false,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-certificates.png',
			'version'     => '2.2.6',
			'description' => 'An addon for LearnPress plugin to create certificate for a course By ThimPress.',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress Co-Instructors',
			'slug'        => 'learnpress-co-instructor',
			'premium'     => true,
			'required'    => false,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-co-instructor.png',
			'version'     => '2.0.2',
			'description' => 'Building courses with other instructors By ThimPress.',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress - Content Drip',
			'slug'        => 'learnpress-content-drip',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.2.2',
			'description' => 'Decide when learners will be able to access the lesson content.',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress - Gradebook',
			'slug'        => 'learnpress-gradebook',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.0.1',
			'description' => 'Adding Course Gradebook for LearnPress.',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress - myCred Integration',
			'slug'        => 'learnpress-mycred',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.0.1',
			'description' => 'Running with the point management system - myCred.',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress - Randomize Quiz Questions',
			'slug'        => 'learnpress-random-quiz',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.1.1',
			'description' => 'Mix all available questions in a quiz',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress - Stripe Payment',
			'slug'        => 'learnpress-stripe',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.0.1',
			'description' => 'Stripe payment gateway for LearnPress',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress - Sorting Choice Question',
			'slug'        => 'learnpress-sorting-choice',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.1.0',
			'description' => 'Sorting Choice provide ability to sorting the options of a question to the right order',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress - Students List	',
			'slug'        => 'learnpress-students-list',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.0.1',
			'description' => 'Get students list by filters.',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress Collections',
			'slug'        => 'learnpress-collections',
			'premium'     => true,
			'required'    => false,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-collections.png',
			'version'     => '2.1.2',
			'description' => 'Collecting related courses into one collection by administrator By ThimPress.',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress - Paid Memberships Pro',
			'slug'        => 'learnpress-paid-membership-pro',
			'premium'     => true,
			'required'    => false,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/learnpress-paid-membership-pro.png',
			'version'     => '2.3.1',
			'description' => 'Paid Membership Pro add-on for LearnPress By ThimPress.',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress Course Review',
			'slug'        => 'learnpress-course-review',
			'required'    => false,
			'version'     => '2.0',
			'description' => 'Adding review for course By ThimPress.',
			'add-on'      => true,
		),

		array(
			'name'        => 'LearnPress - WooCommerce Payments',
			'slug'        => 'learnpress-woo-payment',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.4.4',
			'description' => 'Using the payment system provided by WooCommerce.',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress - Authorize.net Payment',
			'slug'        => 'learnpress-authorizenet-payment',
			'premium'     => true,
			'required'    => false,
			'version'     => '2.0',
			'description' => 'Payment Authorize.net for LearnPress.',
			'add-on'      => true,
		),

		array(
			'name'        => 'LearnPress Wishlist',
			'slug'        => 'learnpress-wishlist',
			'required'    => false,
			'version'     => '2.0',
			'description' => 'Wishlist feature By ThimPress.',
			'add-on'      => true,
		),
		array(
			'name'        => 'LearnPress bbPress',
			'slug'        => 'learnpress-bbpress',
			'required'    => false,
			'version'     => '2.0',
			'description' => 'Using the forum for courses provided by bbPress By ThimPress.',
			'add-on'      => true,
		),
		array(
			'name'        => 'SiteOrigin Page Builder',
			'slug'        => 'siteorigin-panels',
			'required'    => true,
			'version'     => '2.4.25',
			'description' => 'A drag and drop, responsive page builder that simplifies building your website. By SiteOrigin.',
		),
		array(
			'name'        => 'Social Login',
			'slug'        => 'miniorange-login-openid',
			'required'    => false,
			'version'     => '5.1',
			'description' => 'Allow your users to login, comment and share with Facebook, Google, Twitter, LinkedIn etc using customizable buttons. By miniOrange.',
		),
		array(
			'name'        => 'MailChimp for WordPress',
			'slug'        => 'mailchimp-for-wp',
			'required'    => false,
			'version'     => '4.1.0',
			'description' => 'MailChimp for WordPress by ibericode. Adds various highly effective sign-up methods to your site. By ibericode.',
		),
		array(
			'name'        => 'WooCommerce',
			'slug'        => 'woocommerce',
			'required'    => false,
			'version'     => '3.0.4',
			'description' => 'An e-commerce toolkit that helps you sell anything. Beautifully. By WooThemes.',
		),
		array(
			'name'        => 'Paid Memberships Pro',
			'slug'        => 'paid-memberships-pro',
			'required'    => false,
			'version'     => '1.9.1',
			'description' => 'A revenue-generating machine for membership sites. Unlimited levels with recurring payment, protected content and member management.',
		),
		array(
			'name'     => 'Widget Logic',
			'slug'     => 'widget-logic',
			'required' => false,
		),
		array(
			'name'        => 'Black Studio TinyMCE Widget',
			'slug'        => 'black-studio-tinymce-widget',
			'required'    => false,
			'version'     => '2.3.1',
			'description' => 'Adds a new “Visual Editor” widget type based on the native WordPress TinyMCE editor. By Black Studio.',
		),
		array(
			'name'        => 'LearnPress Wishlist',
			'slug'        => 'learnpress-wishlist',
			'required'    => false,
			'version'     => '2.0',
			'description' => 'Wishlist feature By ThimPress.',
			'add-on'      => true,
		),
		array(
			'name'     => 'YITH WooCommerce Compare',
			'slug'     => 'yith-woocommerce-compare',
			'icon'     => 'https://ps.w.org/yith-woocommerce-compare/assets/icon-128x128.jpg',
			'required' => false,
		),
		array(
			'name'        => 'Thim Our Team',
			'slug'        => 'thim-our-team',
			'premium'     => true,
			'required'    => false,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/thim-our-team.png',
			'version'     => '1.3.1',
			'description' => 'A plugin that allows you to show off your team members. By ThimPress.',
		),
		array(
			'name'        => 'Thim Testimonials',
			'slug'        => 'thim-testimonials',
			'premium'     => true,
			'icon'        => 'https://plugins.thimpress.com/downloads/images/thim-testimonials.png',
			'required'    => false,
			'version'     => '1.3.1',
			'description' => 'A plugin that allows you to show off your testimonials. By ThimPress.',
		),
		array(
			'name'        => 'bbPress',
			'slug'        => 'bbpress',
			'required'    => false,
			'version'     => '2.5.12',
			'description' => 'bbPress is forum software with a twist from the creators of WordPress. By The bbPress Community.',
		),
		array(
			'name'        => 'Contact Form 7',
			'slug'        => 'contact-form-7',
			'required'    => false,
			'version'     => '4.7',
			'description' => 'Just another contact form plugin. Simple but flexible. By Takayuki Miyoshi.',
		),
		array(
			'name' => 'Instagram Feed',
			'slug' => 'instagram-feed',
		),
	);
}

add_action( 'thim_core_get_all_plugins_require', 'thim_get_all_plugins_require' );