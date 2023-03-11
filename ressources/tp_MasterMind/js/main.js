function userDif(dif) {
    localStorage.setItem('dificulte', dif)

    var pseudo = document.getElementById("pseudoInput").value;
    localStorage.setItem('pseudo', pseudo)

    window.location.href = "jeu"
}