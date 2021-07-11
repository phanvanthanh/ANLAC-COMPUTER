var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   console.log(st);
   if (st > lastScrollTop && st>250){
       // downscroll code
       var height=jQuery('#order-listing thead tr').attr('height');
        jQuery('#order-listing thead tr').css({
            'position': 'fixed',
            'margin-top': '-262px',
            'z-index': '100000'
        });
   } else {
        if(st<250){
            // upscroll code
            jQuery('#order-listing thead tr').css({
                'position': 'relative',
                'margin-top': '0px',
                'z-index': '100000'
            });
        }
          
   }
   lastScrollTop = st;
});