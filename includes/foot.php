</div>
               <!---->
            </div>
            <!--/row-fluid-->
         </div>
         <!-- /container -->
         <div id="push">
            <!-- pushes footer down -->
         </div>
      </div>
	  <!-- /stickyfooter wrapper -->
      <!-- Footer with (map) navs, fine print and document close
================================================== -->
      <footer class="achieve-2">
         <div class="container">
            <div class="row">
               <div class="span12">
                  <h3 class="center">UTC Library</h3>
               </div>
            </div>
            <div class="row">
               <div class="span12">
                  <p class="achieve pushup center">UTC Library
                     &nbsp;|&nbsp;
                     Dept 6456
                     &nbsp;|&nbsp;
                     600 Douglas Street
                     &nbsp;|&nbsp;
                     Chattanooga, TN 37403
                     &nbsp;|&nbsp;
                     (423) 425-4501<abbr title="Phone"> p</abbr>
                     &nbsp;|&nbsp;
                     <a href="//www.utc.edu/library/about/contact.php">Contact Us</a></p>
               </div>
            </div>
         </div><div class="container">
<div class="row">
<div class="span12">
<p class="fineprint"><a id="legal-questions" href="//www.utc.edu/about/contact/">Questions?</a> <span id="directedit">©</span>&nbsp;2012-2015 The University of Tennessee at Chattanooga. All rights reserved. <a id="legal-eeo" href="//www.utc.edu/university-relations/editorial-guidelines/eeo.php">EEO Statement</a>. <a id="legal-privacy" href="//www.utc.edu/about/privacy.php">Privacy Statement</a>.</p>
<p class="fineprint">A comprehensive, community-engaged campus of the <a id="legal-ut" href="//www.tennessee.edu/" target="_blank">University of Tennessee System</a> <a href="//www.tennessee.edu/" target="_blank"><img src="//www.utc.edu/images/ut-icon-bw.png" alt="University of Tennessee UT logo" width="35" height="20" /></a></p>
<p class="fineprint">and partner in the <a id="global-footer-nav1-transfers" href="//www.tntransferpathway.org/" target="_blank"><img style="margin-top: -10px;" src="//www.utc.edu/images/tn-transfer-pathway-logo.png" alt="Tennessee Transfer Pathway logo" width="172" height="34" /></a></p>
</div>
</div>
</div>
      </footer>
      </body>
      <!-- document close
================================================== --><!-- FOOTER - jQuery 1.8 series for OU LDP compatibility -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!-- Common Bootstrap Scripts for all pages -->
<script type="text/javascript" src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<!-- Fit Text plugin for big hero-unit -->
<script type="text/javascript" src="//www.utc.edu/_resources/Kickstrap/apps/fittext/jquery.fittext.js"></script>
<!-- Image Zoom plugin -->
<script type="text/javascript" src="//www.utc.edu/_resources/Kickstrap/apps/zoom/jquery.zoom.js"></script>
<!-- Document Ready scripts for all pages -->
<script type="text/javascript" src="//www.utc.edu/_resources/Kickstrap/apps/thememain/main.js"></script>
<script type="text/javascript">
if ((window.location.href.indexOf("test.utc.edu") > -1)||(window.location.href.indexOf("192.168.33.10") > -1)) {
	$("#dev-environment").show();
};
</script>
<?php print $addfoot;
if ($help === "show"){
  echo "<style><!--
#sidemenu a.accordion-toggle:not(.collapsed){
  background-color: #D9D9D9;
}
#sidemenu ul > li.spacer {
    background-color: #d6dfe8;
    padding: 0px 13px;
    font-style: italic;
}
#sidemenu ul.nav-department > li.active > a {
    text-shadow: none;
    background-color: #ADAFAA;
    color: white;
}
#libraryh3lp:hover {
	background-color:#E0AA0F;
}
#libraryh3lp:hover a{
		padding-bottom:10px;
		}
#libraryh3lp:hover i{
	color:#781e1e;
		}
#libraryh3lp a{
	text-decoration: none;
	color: white;
	}
#libraryh3lp i{
	color:#E0AA0F;
	}
#libraryh3lp {
    border: 1px solid whitesmoke;
		 right: 0;
   -webkit-transform-origin: 100% 50%;
      -moz-transform-origin: 100% 50%;
       -ms-transform-origin: 100% 50%;
        -o-transform-origin: 100% 50%;
           transform-origin: 100% 50%;
   -webkit-transform: rotate(270deg) translate(50%, 50%);
      -moz-transform: rotate(270deg) translate(50%, 50%);
       -ms-transform: rotate(270deg) translate(50%, 50%);
        -o-transform: rotate(270deg) translate(50%, 50%);
           transform: rotate(270deg) translate(50%, 50%);
	box-shadow: 0 2px 4px rgba(0,0,0,.4), 0 4px 8px rgba(0,0,0,.15);
    background: #781e1e;
    border-radius: .5em .5em 0 0 ;
    -moz-border-radius: .5em .5em 0 0 ;
    -webkit-border-radius: .5em .5em 0 0 ;
    bottom: 50%;
    color: white;
    cursor: pointer;
    font-size: 22px;
    line-height: 150%;
    padding: 5px 20px 5px 20px;
    position: fixed;
    text-align: center;
    z-index: 1000;
    right: 40px;
}
--></style>
<div id='libraryh3lp'><a href='https://www.utc.edu/library/help'><i class='icon-comment' aria-hidden='true'><!-- comment icon --></i> Get Help</a></div>
<!-- side menu tweaks -->
<script type='text/javascript'>// <![CDATA[
$( document ).ready(function() {
    $('ul.breadcrumb li:eq(1)').hide();
	  $('ul.breadcrumb li:eq(1)').next('span').hide();
    $('ul.breadcrumb li:eq(2)').hide();
	  $('ul.breadcrumb li:eq(2)').next('span').hide();

      $( '#sidenav01 .collapsed' ).click(function() {
        var sideMenuLink = $(this).next('ul').find('li:first').find('a').attr('href');
        var delay = 250;
		var sideMenuLink = $(this).next('ul').find('li:first').find('a').attr('href');
			setTimeout(function() {
          		if (sideMenuLink[0] == '/') {
              		window.location.href = sideMenuLink;
          		}
			}, delay);
      });
/* remove scroll
var nav = $('.content');
if (nav.length) {
	$('html, body').animate({
        scrollTop: nav.offset().top-100
    }, 250);
}
*/
  });
  /* captures scroll position to preserve for page reload */
document.addEventListener('DOMContentLoaded', function() {
    if(typeof(Storage) !== 'undefined') {
        // See if there is a scroll pos and go there.
        var lastYPos = +localStorage.getItem('scrollYPos');
        if (lastYPos) {
            window.scrollTo(0, lastYPos);
        }

        // On navigating away first save the position.
        var anchors = document.querySelectorAll('a.collapsed');

        var onNavClick = function() {
            localStorage.setItem('scrollYPos', window.scrollY);
        };

        for (var i = 0; i < anchors.length; i++) {
            anchors[i].addEventListener('click', onNavClick);
        }
    }
	// Clear stored position on any other click
var anchorsOther = document.querySelectorAll('a:not(.collapsed)');
        var onOtherClick = function() {
            localStorage.setItem('scrollYPos', 0);
        };

        for (var i = 0; i < anchorsOther.length; i++) {
            anchorsOther[i].addEventListener('click', onOtherClick);
        }
});
// ]]></script>";
}
?>
