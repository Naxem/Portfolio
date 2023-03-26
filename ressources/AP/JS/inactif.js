let timeout;

function resetTimer() {
  clearTimeout(timeout);
  timeout = setTimeout(logout, 4 * 60 * 1000); // 5 minutes
}

function logout() {
  // Code pour déconnecter l'utilisateur
  window.location.href = "../Staff/deconexion.php"
}

// Ajouter des écouteurs d'événements
document.addEventListener('mousemove', resetTimer);
document.addEventListener('keydown', resetTimer);

// Initialiser le minuteur au chargement de la page
resetTimer();