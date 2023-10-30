//Actions du joueur : en fonction de sa main, le joueur peut choisisr faire un doubler, de se séparer ("splitter") 
//deux cartes identiques pour former deux mains séparées
//blackjack mise * 3
//tableau des scores
//système de mise, gain
//server
//baisser la taille des images quand plus de 4 tirage pour les C et 5 pour le P

const d_card = document.getElementById("card")
const d_pointsPlayer = document.getElementById("d-pointsPlayer")
const d_cardCroupier = document.getElementById("cardCroupier")
const d_pointsCroupier = document.getElementById("d-pointsCroupier")
const pop_up = document.getElementById("pop-up")
const btn_Fermer_pop_up = document.getElementById("btnFermer")
const card_player = []
const card_croupier = []
const cardP = []
let cardC = []
let asP  = []
let asC = []
let tirage = 0
let tirageC = 0
let nb_pointsP = 0
let nb_pointsC = 0
let num = 0
let as_used = 0
let as_used_croup = 0
let all_cards = []
let all_cards2 = []

function start() {
    random_card(false)
    random_card(true)
    random_card(false)
    random_card(true)

    tirage = 1
    tirageC = 1

    aff_card_player(true)
    aff_card_croupier(true)

    aff_points(false)
    d_pointsPlayer.innerHTML = pointsPlayer + nb_pointsP

    if((nb_pointsP == 21) && (nb_pointsC != 21)) {
        console.log("Blacjack")
    } else if ((nb_pointsP != 21) && (nb_pointsC == 21)) {
        console.log("Perdu")
    } else if ((nb_pointsP == 21) && (nb_pointsC == 21)) {
        console.log("Push")
    }
}

function tireCard() {
    random_card(true)
    tirage++
    aff_card_player()
}

function stopCard() {
    aff_card_croupier()
}

function affRegle() {
    window.location.href = "/casino/blackjack/regle_BJ"; // Redirige vers une autre URL
}

function condition(isEnd) {
    if(isEnd) {
        if(nb_pointsC > 21) {
            //alert("Tu a gagner !")
            pop_up.style.display = "block"
            popUp(1)
            console.log("gagner"+nb_pointsC + "//" + nb_pointsP)
        } else if((nb_pointsC > nb_pointsP) && (nb_pointsC <= 21)) {
            //alert("Tu a perdu !")
            pop_up.style.display = "block"
            popUp(2)
            console.log("perdu"+ nb_pointsC + "//" + nb_pointsP)
        } else if((nb_pointsC == nb_pointsP) && (nb_pointsC <= 21) && (nb_pointsP <= 21)) {
            //alert("égalité !")
            pop_up.style.display = "block"
            popUp(0)
            console.log("égalité"+nb_pointsC + "//" + nb_pointsP)
        } else if((nb_pointsC < nb_pointsP) && (nb_pointsP <= 21)) {
            //alert("Tu a gagner !")
            pop_up.style.display = "block"
            popUp(1)
            console.log("gagner"+nb_pointsC + "//" + nb_pointsP)
        } else if((nb_pointsC < nb_pointsP) && (nb_pointsP > 21)) {
            //alert("Tu a perdu !")
            pop_up.style.display = "block"
            popUp(2)
            console.log("sauter"+ nb_pointsC + "//" + nb_pointsP)
        } else {
            console.log("Une erreur est survenu : Condition non pris en charge")
            location.reload()
        }
    }
    if((nb_pointsP > 21)) {
        pop_up.style.display = "block"
        popUp(2)
    }
    if(nb_pointsP == 21) { //Blacjack 🔥
        pop_up.style.display = "block"
        popUp(1)
    }
    btn_Fermer_pop_up.addEventListener("click", function() {
        pop_up.style.display = "none"
        location.reload()
    });
}

function aff_points(affPC) {
    if(affPC) {
        //console.log("Points du croupier : " + nb_pointsC)
        //onsole.log("Points du player : " + nb_pointsP)
    } else {
        nb = count_points(card_croupier[1][3], false)
        nb_pointsC = nb_pointsC - nb
        console.log(nb_pointsC = nb_pointsC - nb) // enlever quand la solution sera trouver
        //console.log("Points du croupier : " + nb_pointsC)
        //console.log("Points du player : " + nb_pointsP)
        d_pointsCroupier.innerHTML = pointsCroupier + nb_pointsC
        nb_pointsC = nb_pointsC + nb
    }
}

function img_card(tab_couleur, tab_number) {
    let number, couleur = null
    switch(tab_couleur) {
        case "coeur":
            couleur = "coeur"
            break;
        case "losange":
            couleur = "carro"
            break;
        case "trefle":
            couleur = "trefle"
            break;
        case "pique":
            couleur = "pique"
            break;
    }

    switch(tab_number) {
        case "as":
            number = 1
            break;
        case 2:
            number = 2
            break;
        case 3:
            number = 3
            break;
        case 4:
            number = 4
            break;
        case 5:
            number = 5
            break;
        case 6:
            number = 6
            break;
        case 7:
            number = 7
            break;
        case 8:
            number = 8
            break;
        case 9:
            number = 9
            break;
        case 10:
            number = 10
            break;
        case "valet":
            number = 11
            break;
        case "dame":
            number = 12
            break;
        case "roi":
            number = 13
            break;
    }
    let img = number + "-" + couleur + ".png"
    return img
}

function aff_card_player(isStrart) {
    let j = 0
    if(isStrart) {
        console.log("Player couleur : " + card_player[0][j] + "    //  number : " + card_player[0][j+1])
        let img_aff = img_card(card_player[0][j], card_player[0][j+1])
        d_card.innerHTML = '<div class="d-card"><img src="ressources/card/' + img_aff + '" alt="' + img_aff +'"></div>' //affichage card
        j = j + 2
        img_aff = img_card(card_player[1][j], card_player[1][j+1])
        console.log("Player couleur : " + card_player[1][j] + "    //  number : " + card_player[1][j+1])
        d_card.innerHTML += '<div class="d-card"><img src="ressources/card/' + img_aff + '" alt="' + img_aff +'"></div>' //affichage card
    } else {
        asP = []
        for(var o = 0; o < card_player[0].length; o = o + 2) {
            if(card_player[0][o+1] === "as") {
                asP.push(o);
            }
        }

        for(var i = 0; i < tirage+1; i++) {
            console.log("Player couleur : " + card_player[i][j] + "   //   number : " + card_player[i][j+1])
            img_aff = img_card(card_player[i][j], card_player[i][j+1])
            if(i === 0) {
                d_card.innerHTML = '<div class="d-card"><img src="ressources/card/' + img_aff + '" alt="' + img_aff +'"></div>' //affichage card
            } else {
                d_card.innerHTML += '<div class="d-card"><img src="ressources/card/' + img_aff + '" alt="' + img_aff +'"></div>' //affichage card
            }
            j = j + 2
        }

        for(var o = 0; o < asP.length; o++) {
            if(nb_pointsP > 21 && as_used < asP.length) {
                nb_pointsP = nb_pointsP - 10  
                //console.log(nb_pointsP + " tester avec as - 10 si on est a 21 //// 2")
                as_used += 1;
            }
        }
        
        if(nb_pointsP >= 21) {
            aff_points(false)
            d_pointsPlayer.innerHTML = pointsPlayer + nb_pointsP
            condition(true)
        } else {
            aff_points(false)
            d_pointsPlayer.innerHTML = pointsPlayer + nb_pointsP
            condition(false)
        }
    }
}

function aff_card_croupier(isStart) {
    let j = 0
    let end = false
    if(isStart) {
        //1er affichage des cartes du croupier
        console.log("Croupier couleur : " + card_croupier[0][j] + "    //  number : " + card_croupier[0][j+1])
        img_aff = img_card(card_croupier[0][j], card_croupier[0][j+1])
        d_cardCroupier.innerHTML = '<div class="d-card"><img src="ressources/card/' + img_aff + '" alt="' + img_aff +'"></div>' //affichage card
        j = j + 2
        console.log("Croupier couleur : " + card_croupier[1][j] + "    //  number : " + card_croupier[1][j+1])
        //console.log("Croupier couleur : masquer " + "    //  number : masquer")
        d_cardCroupier.innerHTML += '<div class="d-card"><img src="ressources/card/0.png" alt="dos de carte"></div>' //affichage card
    } else {
        asC = []
        //add as dans l'array
        for(var o = 0; o < card_croupier[0].length; o = o + 2) {
            if(card_croupier[0][o+1] === "as") {
                asC.push(o);
            }
        }

        //teste du passage des as a 1 points
        for(var o = 0; o < asC.length; o++) {
            if(nb_pointsP > 21 && as_used_croup < asC.length) {
                nb_pointsC = nb_pointsC - 10  
                //console.log(nb_pointsC + " tester avec as - 10 si on est a 21 //// 2")
                as_used_croup += 1;
            }
        }

        /*Affichage des cartes du croupier*/
        for(var i = 0; i < tirageC+1; i++) {
            console.log("Croupier couleur : " + card_croupier[i][j] + "    //  number : " + card_croupier[i][j+1])
            img_aff = img_card(card_croupier[i][j], card_croupier[i][j+1])
            if(i === 0) {
                d_cardCroupier.innerHTML = '<div class="d-card"><img src="ressources/card/' + img_aff + '" alt="' + img_aff +'"></div>' //affichage card
            } else {
                d_cardCroupier.innerHTML += '<div class="d-card"><img src="ressources/card/' + img_aff + '" alt="' + img_aff +'"></div>' //affichage card
            }
            j = j + 2
        }
        aff_points(false)
        d_pointsCroupier.innerHTML = pointsCroupier + nb_pointsC
        
        /*Condition de fin de la boucle*/
        while(end = true) {
            if(nb_pointsC >= 17) {
                end = true
                break
            } else {
                tirageC++
                random_card(false)
                aff_card_croupier()
            }
        }
        condition(true)
        return
    }
}

function random_card(isPlayer) {
    let card_color;
    let card_number;

    while (true) {
        card_color = Math.floor(Math.random() * 4) + 1;
        card_number = Math.floor(Math.random() * 13) + 1;
    
        switch (card_color) {
          case 1:
            card_color = "coeur";
            break;
          case 2:
            card_color = "losange";
            break;
          case 3:
            card_color = "trefle";
            break;
          case 4:
            card_color = "pique";
            break;
          default:
            console.log("Une erreur est survenue : ");
            throw err;
        }
    
        switch (card_number) {
          case 1:
            card_number = "as";
            break;
          case 2:
            break;
          case 3:
            break;
          case 4:
            break;
          case 5:
            break;
          case 6:
            break;
          case 7:
            break;
          case 8:
            break;
          case 9:
            break;
          case 10:
            break;
          case 11:
            card_number = "valet";
            break;
          case 12:
            card_number = "dame";
            break;
          case 13:
            card_number = "roi";
            break;
          default:
            console.log("Une erreur est survenue : ");
            throw err;
        }
    
        if (!all_cards.includes(card_color) || !all_cards2.includes(card_number)) {
          all_cards.push(card_color);
          all_cards2.push(card_number);
          break;
        }
      }
    
    if(isPlayer) {
        cardP.push(card_color)
        cardP.push(card_number)

        card_player.push(cardP)
        count_points(card_number, true)
    } else {
        cardC.push(card_color)
        cardC.push(card_number)

        card_croupier.push(cardC)
        count_points(card_number, false)
    }
}

function count_points(number_card, isP) {
    switch(number_card) {
        case "as" :
            if(isP) {
                if(nb_pointsP + 11 > 21) {
                    num = 1
                    as = card_player[card_player.length-1].length
                    asP.push(as)
                } else {num = 11}
            } else {
                if(nb_pointsC + 11 > 21) {
                    num = 1
                    as = card_croupier[card_croupier.length-1].length
                    asC.push(as)
                } else {num = 11}
            }
            break;
        case 2 :
            num = 2
            break;
        case 3 :
            num = 3
            break;
        case 4 :
            num = 4
            break;
        case 5 :
            num = 5
            break;
        case 6 :
            num = 6
            break;
        case 7 :
            num = 7
            break;
        case 8 :
            num = 8
            break;
        case 9 :
            num = 9
            break;
        case 10 :
            num = 10
            break;
        case "valet" :
            num = 10
            break;
        case "dame" :
            num = 10
            break;
        case "roi" :
            num = 10
            break;
        default :
            console.log("Une erreur est survenu : ")
            throw(err)
    }

    if(isP) {
        nb_pointsP = nb_pointsP + num
    } else {
        nb_pointsC = nb_pointsC + num
    }
    return num
}