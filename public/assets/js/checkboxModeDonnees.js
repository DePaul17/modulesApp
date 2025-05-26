document.addEventListener("DOMContentLoaded", function() {
    const switchInput = document.getElementById("flexSwitchCheckDefault");
    const notificationsDiv = document.getElementById("notificationsDiv");
    const tableDiv = document.getElementById("tableDiv");

    // On récupère l'état sauvegardé dans le localStorage
    const isChecked = localStorage.getItem("switchState") === "true";
    switchInput.checked = isChecked;

    // On affiche ou masque les divs au chargement initial
    if (isChecked) {
      notificationsDiv.style.display = "none"; // Ici on masque les notifications
      tableDiv.style.display = "block"; // Et on affiche le tableau
    } else {
      notificationsDiv.style.display = "block"; // Ici on affiche les notifications
      tableDiv.style.display = "none"; // Et on masque le tableau
    }

    // On met à jour l'affichage et le localStorage quand l'utilisateur change l'état du switch
    switchInput.addEventListener("change", function() {
      localStorage.setItem("switchState", switchInput.checked);

      if (switchInput.checked) {
        notificationsDiv.style.display = "none"; // On masque les notifications
        tableDiv.style.display = "block"; // On affiche le tableau
      } else {
        notificationsDiv.style.display = "block"; // On affiche les notifications
        tableDiv.style.display = "none"; // On masque le tableau
      }
    });
  });