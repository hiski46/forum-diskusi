$(document).ready(function() {
    hideLoader();
    $('a:not(.no-load)').click(function(){
        showLoader()
    })
})


function showLoader() {
    $('.loading').show()
}

function hideLoader(){
    $('.loading').hide('slow')
}

window.addEventListener( "pageshow", function ( event ) {
    var historyTraversal = event.persisted || 
                           ( typeof window.performance != "undefined" && 
                                window.performance.navigation.type === 2 );
    if ( historyTraversal ) {
      // Handle page restore.
      window.location.reload();
    }
  });