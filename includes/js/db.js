console.log('db.js loaded');

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
