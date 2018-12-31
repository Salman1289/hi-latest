jQuery(document).ready(function(){

   // jQuery methods go here...

jQuery('.footer-social-widget ul li a').mouseover(function() {

  jQuery(this).find('span').css('background', '#23a897'); // change css

});

jQuery('.footer-social-widget ul li a').mouseleave(function() {

   jQuery(this).find('span').css("background", "#fff"); // change back css as it was

});



// var getUrl = window.location; // this is the link of current page i-e about us if.
// var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
// the above code is the baseurl of a website

jQuery("#pgc-313-1-0").prepend("<div class='about-counter-img' ><img src='http://localhost/hybrid-ins/wp-content/themes/elearningwp-child/images/learners.png'/></div>" );

jQuery("#pgc-313-1-1").prepend("<div class='about-counter-img' ><img src='http://localhost/hybrid-ins/wp-content/themes/elearningwp-child/images/graduates.png'/></div>" );

jQuery("#pgc-313-1-2").prepend("<div class='about-counter-img' ><img src='http://localhost/hybrid-ins/wp-content/themes/elearningwp-child/images/customers.png'/></div>" );

jQuery("#pgc-313-1-3").prepend("<div class='about-counter-img' ><img src='http://localhost/hybrid-ins/wp-content/themes/elearningwp-child/images/course-published.png'/></div>" );
});