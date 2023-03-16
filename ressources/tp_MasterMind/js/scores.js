const data = JSON.parse(localStorage.getItem("tab_scores"));
const taille = data.length
let couleur = ""
let status = ""

for(var j = 0; j < localStorage.getItem("tab_scores").length; j++) {
    data.push(localStorage.getItem("tab_scores")[j])
}

const tableau = document.getElementById('tableau')

if(taille.length === 0) {
    tableau.insertAdjacentHTML('beforeend', `<tr><td>Aucune partie joué</td><td>Aucune partie joué</td><td>Aucune partie joué</td></tr>`)
} else {

    for (var i = 0; i < taille; i++) {
        if(data[i].status === 'Gagné') {
            couleur = '#26cc26';
        } else {
            couleur = 'red'
        }
        if(data[i].r === true) {
            status = "Gagner"
        } else {
            status = "Perdu"
        }
        tableau.insertAdjacentHTML('beforeend', `<tr><td>${data[i].pseudo}</td><td>${data[i].dificulte}</td><td>${data[i].nbrEssai}</td>
        <td style="background-color:${couleur}; color:#FFFFFF">${data[i].status}</td></tr>`)
    }
}