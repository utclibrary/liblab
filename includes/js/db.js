console.log("loaded");
$(document).ready(function() {
  restartTooltip();
  var url = window.location.pathname;
  var filename = url.substring(url.lastIndexOf('/') + 1);
  $('.subjects li').each(function() {
    var subject = $(this).text();
    if (subject == 'New') {
      $(this).closest('li').hide();
    } else {
      if (subject.indexOf('Subject') <= -1) {
        $(this).html('<a href=\"' + filename + '?subj=' + subject + '\">' + subject + '</a>');
      }
    }
  });
  /* get content of totalCount */
  var cloneTotalResults = $('#totalResults').text();
  /* get content from list */
  var highlightListContent = $('.highlight_list').html();
  /* on keyup modify total results or reset to orig */
  $('#search-highlight').keyup(function() {
    if ($(this).val() == '') { // check if value changed
      $('#totalResults').html(cloneTotalResults);
      $('#alphaRankedSortBtn').show();
      $('#promos').slideDown();
    } else {
      var term = $(this).val();
      $('h2.no-results').html('<p>We did not find any databases with that description or name. Please try again.</p> <p>If you would like to search by topic, use the library <a href=\"https://utc.primo.exlibrisgroup.com/discovery/search?query=any,contains,' + term + '&tab=Everything&search_scope=MyInst_and_CI&vid=01UTC_INST:01UTC&offset=0\" target=\"_blank\">Quick Search (for \"' + term + '\")</a>.</p>');
      var totalResults = $('.dbCard:visible').length;
      $('#totalResults').html('Total results: ' + totalResults);
    }
  });
  $('[data-toggle=\"tooltip\"]').tooltip();
  /* jquery for clearable fields */
  // CLEARABLE INPUT
  function tog(v) {
    return v ? 'addClass' : 'removeClass';
  }
  $(document).on('input', '.clearable', function() {
    $('#alphaRankedSortBtn').hide();
    $('#promos').slideUp();
    $('.highlight_list').html(highlightListContent);
    $(this).addClass('input-hold');
    $('.clearable')[tog(this.value)]('x');
  }).on('mousemove', '.x', function(e) {
    $('.clearable')[tog(this.offsetWidth - 18 < e.clientX - this.getBoundingClientRect().left)]('onX');
    $(this).removeClass('input-hold');
  }).on('touchstart click', '.onX', { passive: true }, function(ev) {
    $(this).removeClass('input-hold');
    ev.preventDefault();
    $('.clearable').removeClass('x onX').val('').change();
    $('#totalResults').html(cloneTotalResults);
    $('.highlight_list').html(highlightListContent); $('h2#Letter1').text('#');
    resetsearch();
  });
  var divContent = $('div.dbCard');
  $('#numBtn').attr('disabled', 'disabled');
  var sliContent = $('#subject_list_items').html();
  $('#alphBtn').on('click', function() {
    $('#numBtn').removeAttr('disabled');
    $(this).attr('disabled', 'disabled');
    var alphabeticallyOrderedDivs = divContent.sort(function(a, b) {
      return $(a).find('h3.dbTitle > a').text() > $(b).find('h3.dbTitle a').text() ? 1 : -1;
    });
    $('#subject_list_items').html(alphabeticallyOrderedDivs);
    restartTooltip();
  });
  $('#numBtn').on('click', function() {
    $('#alphBtn').removeAttr('disabled');
    $(this).attr('disabled', 'disabled');
    $('#subject_list_items').html(sliContent);
    restartTooltip();
  });

}); /* close doc ready */
$('#search-highlight').hideseek({
  min_chars: 3,
  highlight: true,
  nodata: 'No results found'
});
/* reload page on subject select */
$('#subjectSelect').change(function() {
  window.location.href = window.location.href.split('?')[0] + '?alpha=ALL&subj=' + $('#subjectSelect').val();
});
/* reload page on type select */
$('#typeSelect').change(function() {
  window.location.href = window.location.href.split('?')[0] + '?alpha=ALL&subj=' + $('#typeSelect').val();
});

function showIntro() {
  $('#libraryh3lp').css('position', 'absolute');
  var intro = introJs().setOptions({
    scrollTo: 'tooltip',
    steps: [{
        element: document.querySelector('#content h1'),
        intro: 'Welcome to our new databases page! This page can help you find the UTC Library database that best meets your information needs.'
      },
      {
        element: document.querySelector('#alphalist'),
        intro: 'Filter using the first letter of the database name, subject area, or resource type.'
      },
      {
        element: document.querySelector('#search-highlight'),
        intro: 'Search for databases by name or description.'
      },
      {
        element: document.querySelector('#limitByGroup'),
        intro: 'Filter databases by subject area or resource type.'
      },
      {
        element: document.querySelector('.fa-info-circle'),
        intro: 'Learn more about databases and related resources.'
      },
      {
        element: document.querySelector('.promoCard1'),
        intro: 'Muti-subject databases are a great place to start your research.'
      },
      {
        element: document.querySelector('#libraryh3lp'),
        intro: 'Need help selecting a database or with your research? Ask a Librarian!'
      }
    ].filter(function(obj) {
      return $(obj.element).parent().is(':visible');
    })
  }).start();

  intro.onexit(function() {
    $('#libraryh3lp').css('position', 'fixed');
  });

}

function scrollToBox() {
  $('html, body').animate({
    scrollTop: $('.filters').offset().top
  }, 500);
};

function restartTooltip() {
  $('[data-toggle=\"tooltip\"]').tooltip();
}
$(function() {
  $('[data-toggle=popover]').popover({
    html: true,
    content: function() {
      var content = $(this).attr('data-popover-content');
      return $(content).children('.popover-body').html();
    },
    title: function() {
      var title = $(this).attr('data-popover-content');
      return $(title).children('.popover-heading').html();
    }
  });
});

function resetsearch() {
  $('#alphaRankedSortBtn').show();
  $('#search-highlight').val('').trigger('keyup').focus();
  var press = jQuery.Event('keypress');
  press.bubbles = true;
  press.cancelable = true;
  press.charCode = 8;
  press.currentTarget = $('#search')[0];
  press.eventPhase = 2;
  press.keyCode = 8;
  press.returnValue = true;
  press.srcElement = $('#search')[0];
  press.target = $('#search')[0];
  press.type = 'keyup';
  press.view = Window;
  press.which = 8;
  $('#search-highlight').trigger(press);
}
Popper.Defaults.modifiers.computeStyle.gpuAcceleration = !(window.devicePixelRatio < 1.5 && /Win/.test(navigator.platform));
$('body').on('click', function(e) {
  //did not click a popover toggle, or icon in popover toggle, or popover
  if ($(e.target).data('toggle') !== 'popover' &&
    (!$(e.target).parents().hasClass('popover')) &&
    $(e.target).parents('[data-toggle=\"popover\"]').length === 0 &&
    $(e.target).parents('.popover.in').length === 0) {
    $('[data-toggle=\"popover\"]').popover('hide');
  }
});
