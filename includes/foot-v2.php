</div>
               <!---->
            </div>
            <!--/column-->
          </div>
          <!--/row-->
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
         <div class="container topMargin">
            <div class="row">
               <div class="col">
                  <h3 class="center">UTC Library</h3>
               </div>
            </div>
            <div class="row">
               <div class="col">
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
<div class="col">
<p class="fineprint"><a id="legal-questions" href="//www.utc.edu/about/contact/">Questions?</a> <span id="directedit">©</span>&nbsp;2012-2015 The University of Tennessee at Chattanooga. All rights reserved. <a id="legal-eeo" href="//www.utc.edu/university-relations/editorial-guidelines/eeo.php">EEO Statement</a>. <a id="legal-privacy" href="//www.utc.edu/about/privacy.php">Privacy Statement</a>.</p>
<p class="fineprint">A comprehensive, community-engaged campus of the <a id="legal-ut" href="//www.tennessee.edu/" target="_blank">University of Tennessee System</a> <a href="//www.tennessee.edu/" target="_blank"><img src="//www.utc.edu/images/ut-icon-bw.png" alt="University of Tennessee UT logo" width="35" height="20" /></a></p>
<p class="fineprint">and partner in the <a id="global-footer-nav1-transfers" href="//www.tntransferpathway.org/" target="_blank"><img style="margin-top: -10px;" src="//www.utc.edu/images/tn-transfer-pathway-logo.png" alt="Tennessee Transfer Pathway logo" width="172" height="34" /></a></p>
</div>
</div>
</div>
<button onclick="topFunction()" id="backToTopBtn" data-toggle="tooltip" title="Go to top"><span class="fa fa-large fa-angle-double-up"></span></button>
      </footer>
      </body>
      <!-- document close -->

<!-- Common Bootstrap Scripts for all pages -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- Fit Text plugin for big hero-unit
<script type="text/javascript" src="//www.utc.edu/_resources/Kickstrap/apps/fittext/jquery.fittext.js"></script>-->
<!-- Image Zoom plugin
<script type="text/javascript" src="//www.utc.edu/_resources/Kickstrap/apps/zoom/jquery.zoom.js"></script>-->
<!-- Document Ready scripts for all pages
<script type="text/javascript" src="//www.utc.edu/_resources/Kickstrap/apps/thememain/main.js"></script>-->
<script type="text/javascript">
if (window.location.href.indexOf("test.utc.edu") > -1) {
	$("#dev-environment").show();
};
if ((window.location.href.indexOf("192.168.33.10") > -1)||(window.location.href.indexOf("localhost:8080") > -1)) {
	$("#dev-environment").show();
  $('#dev-environment').removeClass('alert-info');
  $('#dev-environment').addClass('alert-danger');
  $('#dev-environment').html('| <strong>LOCAL DEV</strong> environment | ');
};
</script>
<?php print $addfoot;
if ($help === "show"){
  echo "
<div id='libraryh3lp'><a href='https://www.utc.edu/library/help'><i class='icon-comment' aria-hidden='true'><!-- comment icon --></i> Ask a Librarian</a></div>
<!-- side menu tweaks -->
<script type='text/javascript'>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById('backToTopBtn').style.display = 'block';
    } else {
        document.getElementById('backToTopBtn').style.display = 'none';
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
// ]]></script>";
}//close if help
?>
