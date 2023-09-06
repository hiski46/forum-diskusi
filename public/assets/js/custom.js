$(document).ready(function() {
    hideLoader();
    $('a').click(function(){
        showLoader();
    })
})


function showLoader() {
    $('.loading').show()
}

function hideLoader(){
    $('.loading').hide('slow')
    
}