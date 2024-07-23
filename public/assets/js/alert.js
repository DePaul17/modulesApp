// Fonction pour masquer les alertes après un délai 5 secondes

setTimeout(function() {
    var successAlert = document.getElementById('successAlert');
    if (successAlert) {
      successAlert.style.display = 'none';
    }

    var errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {
      errorAlert.style.display = 'none';
    }
  }, 3000);

function confirmDelete() {
  return confirm("Êtes-vous sûr de vouloir supprimer ce module ?");
}