let data = JSON.parse(localStorage.getItem("tab_scores")) || []
const taille = data.length

const tbody = document.getElementById('table-body')
console.log(taille)

for (var i = 0; i < taille; i++) {
    const tr = document.createElement('tr')
    const pseudoTd = document.createElement('td')
    const difficulteTd = document.createElement('td')
    const essaisTd = document.createElement('td')
    //const reussiTd = document.createElement('td')
    
    pseudoTd.textContent = data[i].pseudo
    difficulteTd.textContent = data[i].nb_essai
    essaisTd.textContent = data[i].dificulte
    //reussiTd.textContent = data[i].r
        
    tr.appendChild(pseudoTd)
    tr.appendChild(difficulteTd)
    tr.appendChild(essaisTd)
    //tr.appendChild(reussiTd)
    
    tbody.appendChild(tr)
    console.log(data[i].)
}