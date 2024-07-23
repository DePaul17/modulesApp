//Btn Quitter
document.getElementById('close-link').addEventListener('click', function(event) {
    event.preventDefault();
    if (confirm("Êtes-vous sûr de vouloir fermer l'onglet ?")) {
        alert("Merci de fermer l'onglet manuellement."); // Avertissement à l'utilisateur
    }
});
