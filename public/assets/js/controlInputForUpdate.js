document.addEventListener("DOMContentLoaded", function () {
    // On récupère les éléments du formulaire
    const form = document.getElementById("moduleForm");
    const nameInput = document.getElementById("name");
    const descriptionInput = document.getElementById("description");
    const submitButton = document.getElementById("submitButton");
    const popoverButton = document.getElementById("popoverButton");

    // On stocke les valeurs initiales
    const initialName = nameInput.value;
    const initialDescription = descriptionInput.value;

    // Fonction pour normaliser les espaces (remplacer plusieurs espaces par un seul et trim)
    function normalize(text) {
        return text.replace(/\s+/g, ' ').trim();
    }

    // Initialisation de Bootstrap Popover
    const popover = new bootstrap.Popover(popoverButton);

    // On vérifie si les valeurs ont changé pour afficher le bon bouton
    function checkChanges() {
        const currentName = normalize(nameInput.value);
        const currentDescription = normalize(descriptionInput.value);
        const originalName = normalize(initialName);
        const originalDescription = normalize(initialDescription);

        if (currentName !== originalName || currentDescription !== originalDescription) {
            // Si les valeurs ont changé, afficher le bouton de soumission
            submitButton.style.display = "inline-block";
            popoverButton.style.display = "none";
        } else {
            // Sinon, afficher le bouton Popover
            submitButton.style.display = "none";
            popoverButton.style.display = "inline-block";
        }
    }

    // On ajoute des écouteurs d'événements pour détecter les changements
    nameInput.addEventListener("input", checkChanges);
    descriptionInput.addEventListener("input", checkChanges);

    // Appeler la fonction au chargement initial pour définir l'état correct
    checkChanges();
});
