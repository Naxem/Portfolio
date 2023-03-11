const conbinaison = []
const conbinaison_user = []
const round_couleurs = document.getElementsByClassName("color");
let color = ""
var i = 0
var pseudo = localStorage.getItem("pseudo")
let scores = JSON.parse(localStorage.getItem("tab_scores")) || []

while(i < 4) {
    color = getRandomInt(4)
    if(conbinaison.includes(color)) {
        i--
        conbinaison.pop()
    } else {
        conbinaison.push(color)
        i++
    }
}
let nbJeu = false
let nbchoice = 0
let dificulte = localStorage.getItem('dificulte')

//appelle la function pour crééer un tableau
tab(dificulte)

function getRandomInt(max) {
    var color = Math.floor(Math.random() * max) + 1;
    //4 couleur possible : bleu, jaune, rouge et vert
    switch(color) {
        case 1 :
            color = "blue"
            break
        case 2 :
            color = "red"
            break
        case 3 :
            color = "yellow"
            break
        case 4 :
            color = "green"
            break
        default :
            color = "blue"
            break
    }
    return color
}

function userInput(colorInput) {
    test = nbchoice%4
    if(test == 3) {nbJeu = true}
    round_couleurs[nbchoice].style.backgroundColor = colorInput
    conbinaison_user.push(colorInput)
    nbchoice++
    if(nbJeu == true) {
        test_reponse()
        nbJeu = false
    }
}

function test_reponse() {
    let good = 0
    let wrong = 0
    var nb_essai = nbchoice / 4
    console.log(conbinaison)
    //console.log(conbinaison_user)
    for(var i = 0; i < 4; i++) {
        if(conbinaison[i] == conbinaison_user[i]) {
            good++
        } else {
            wrong++
        }
    }
    conbinaison_user.splice(conbinaison)
    const good_result = document.getElementById("bonne-reponse");
    const wrong_result = document.getElementById("mauvaise-reponse");
    good_result.innerText = ("Tu as " + good + " de bonne réponse")
    wrong_result.innerText = ("Tu as " + wrong + " de mauvaise réponse")

    if(good == 4) {
        let r = true
        const tab_scores = [pseudo,nb_essai, dificulte, r]
        scores.push(JSON.stringify(tab_scores))
        localStorage.setItem('tab_scores', JSON.stringify(scores))
        alert("Tu as gagné !!!" + conbinaison)
        location.reload()
    }
    if(nbchoice == round_couleurs.length) {
        let r = false
        const tab_scores = [pseudo,nb_essai, dificulte, r]
        scores.push(JSON.stringify(tab_scores))
        localStorage.setItem('tab_scores', JSON.stringify(scores))
        alert("Tu as perdu !!!" + conbinaison)
        location.reload()
    }
}

function retourF() {
    window.location.href = "index"
}

function tab(dif) {
    let nbLigne = 0
    let ifuse = false
    const tab = document.getElementById("tab")
    switch(dif) {
        case "facile" :
            nbLigne = 10
            break
        case "intermediare" :
            nbLigne = 7
            break
        case "dificile" :
            nbLigne = 5
            break
        default :
            nbLigne = 10
            break
    }
    ifuse = true

    for(var i = 0; i < nbLigne; i++) {
        if(ifuse == true) {
            tab.innerHTML = '<div class="ligne"><div class="color"></div><div class="color"></div><div class="color"></div><div class="color"></div></div>'
            ifuse = false
        } else {
        tab.insertAdjacentHTML('beforeend', '<div class="ligne"><div class="color"></div><div class="color"></div><div class="color"></div><div class="color"></div></div>')
      }
    }
      
}