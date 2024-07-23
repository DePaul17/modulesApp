document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('form-add');

    form.addEventListener('submit', function(event) {
        var nameInput = document.getElementById('name');
        var descriptionInput = document.getElementById('description');
        var confirmationCheck = document.getElementById('confirmationCheck');

        // Vérifie si le nom du module est vide ou contient uniquement des chiffres
        if (nameInput.value.trim() === '' || !isNaN(nameInput.value)) {
            alert('Le nom du module est invalide.');
            event.preventDefault(); // Empêche la soumission du formulaire
            return;
        }

        // Vérifie si la description est vide ou contient uniquement des chiffres
        if (descriptionInput.value.trim() === '' || !isNaN(descriptionInput.value)) {
            alert('La description du module est invalide.');
            event.preventDefault(); // Empêche la soumission du formulaire
            return;
        }

        // Vérifie si la case à cocher est cochée
        if (!confirmationCheck.checked) {
            alert('Veuillez confirmer que vous voulez ajouter ce module.');
            event.preventDefault(); // Empêche la soumission du formulaire
            return;
        }
    });
});