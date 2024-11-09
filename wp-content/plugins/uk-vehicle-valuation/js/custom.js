
function showLoading() {

    var myModal = document.getElementById('loadingModal');
    myModal.addEventListener('shown.bs.modal');
    // jQuery('#loadingModal').modal('show');
    jQuery('#overlay').show();
    
  }
  
  // Hide the loading modal and overlay
  function hideLoading() {
    jQuery('#loadingModal').modal('hide');
    jQuery('#overlay').hide();
  }