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

const conbinaison = []
const conbinaison_user = []
const round_couleurs = document.getElementsByClassName("color");
for(var i = 0; i < 4; i++) {
    conbinaison.push(getRandomInt(4))
}
let nbJeu = false
let nbchoice = 0

function userInput(colorInput) {
    console.log(nbchoice%4)
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
    console.log(conbinaison)
    console.log(conbinaison_user)
    for(var i = 0; i < 4; i++) {
        if(conbinaison[i] == conbinaison_user[i]) {
            good++
        } else {
            wrong++
        }
    }
    if(good == 4) {
        console.log("Bravo !!")
        alert("Tu as gagné !!!")
        location.reload()
    }
    if(nbchoice == round_couleurs.length) {
        console.log("Null !!")
        alert("Tu as perdu !!!" + conbinaison)
        location.reload()
    }
    console.log(good)
    console.log(wrong)
    conbinaison_user.splice(conbinaison)
    const good_result = document.getElementById("bonne-reponse");
    const wrong_result = document.getElementById("mauvaise-reponse");
    good_result.innerHTML = good
    wrong_result.innerHTML = wrong
}

function userDif(dif) {
    let dificulte = ""
    dificulte = dif
    tab(dif)
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