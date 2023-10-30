// Récupérer la langue préférée du navigateur
let userLanguage = navigator.language || navigator.languages[0];
console.log(userLanguage); // Affiche la langue préférée du navigateur

let translations;

// Déclaration des variables de traduction
let translationsFr = {
    title: "BlackJack",
    hit: "Tirer",
    stand: "Rester",
    start: "Démarrer",
    rule: "Règle",
    pointsCroupier: "Points Croupier = ",
    pointsPlayer: "Nombre de points = ",
    title2: "Règle du BlackJack",
    titleRule: "Règles du BlackJack",
    titleH2: "Règle de Base",
    rule: "Le BlackJack est un jeu de carte se jouent de joueur contre croupier.<br><br>Objectif du jeu : L'objectif du blackjack est de battre le croupier en obtenant une main dont la valeur totale est plus proche de 21 que celle du croupier, sans dépasser 21.<br><br>Valeur des cartes : Les cartes numérotées de 2 à 10 ont leur valeur nominale. Les figures (valet, dame, roi) valent toutes 10 points. L'as peut valoir 1 ou 11 points,<br>selon ce qui est plus avantageux pour le joueur.<br><br>Déroulement du jeu : Le croupier distribue deux cartes visibles à chaque joueur, y compris à lui-même. Les joueurs jouent ensuite individuellement avant que le croupier ne joue sa main.<br><br>Actions du joueur : Le joueur a plusieurs options après avoir reçu ses deux cartes initiales :<br>- Hit (Demander une carte) : Le joueur peut demander une carte supplémentaire pour augmenter la valeur de sa main.<br>- Stand (Rester) : Le joueur peut décider de ne pas prendre de carte supplémentaire et de rester avec sa main actuelle.<br>- Double Down (Doubler) : Le joueur peut choisir de doubler sa mise initiale et recevoir une seule carte supplémentaire.<br>- Split (Séparer) : Si les deux premières cartes du joueur ont la même valeur, il peut choisir de les séparer en deux mains distinctes et placer une mise égale sur chaque main.<br>Le joueur peut ensuite jouer chaque main individuellement.<br><br>Valeur des mains : La valeur d'une main est la somme des valeurs de toutes les cartes qu'elle contient. Si la valeur de la main dépasse 21, on dit que le joueur 'saute' ou 'buste' <br>et perd automatiquement sa mise.<br><br>Action du croupier : Une fois que tous les joueurs ont joué, c'est au tour du croupier de jouer. Le croupier suit une règle prédéterminée appelée 'règle du croupier'. En général,<br>le croupier tire des cartes supplémentaires tant que la valeur de sa main est inférieure à 17, puis il s'arrête.<br><br>Résultats du jeu : Une fois que le croupier a terminé de jouer, les résultats sont déterminés :<br>- Si la valeur de la main du joueur est plus proche de 21 que celle du croupier sans dépasser 21, le joueur gagne et reçoit un paiement égal à sa mise.<br>- Si la valeur de la main du croupier dépasse 21, tous les joueurs restants gagnent automatiquement.<br>- Si la valeur de la main du joueur est inférieure à celle du croupier ou si le joueur dépasse 21, le joueur perd sa mise.<br><br>Blackjack : Si les deux premières cartes d'un joueur sont un as et une carte valant 10 (10, valet, dame ou roi), le joueur a un 'blackjack'. Un blackjack est généralement payé à un taux<br>de 3 fois sa mise initiale en plus de sa mise.<br><br>En cas de victoire le joueur reçois le double de ça mise initiale.",
    btnFermer: "Fermer",
    sentence_victory: "Félicitations, vous avez gagné ! 🎉 🎉 🔥",
    sentence_loss: "Désolé, vous avez perdu ! 😪 la victoire sera pour une autre fois 🔥",
    sentence_equal: "Égalité !, vous regagner votre mise 🙃🙂",
    title_popup: "Fin de la partie"
};

let translationsEn = {
    title: "BlackJack",
    hit: "Hit",
    stand: "Stand",
    start: "Start",
    rule: "Rule",
    pointsCroupier: "Points dealer = ",
    pointsPlayer: "Number of points = ",
    title2: "BlackJack rule",
    titleRule: "BlackJack rule",
    titleH2: "Basic rule",
    rule: "Blackjack is a card game played between a player and a dealer.<br><br>Objective of the game: The objective of blackjack is to beat the dealer by obtaining a hand with a total value closer to 21 than the dealer's, without exceeding 21.<br><br>Card values: Numbered cards from 2 to 10 have their face value. Face cards (jack, queen, king) are all worth 10 points. An ace can be worth 1 or 11 points, depending on what is more advantageous for the player.<br><br>Gameplay: The dealer deals two visible cards to each player, including themselves. Players then play individually before the dealer plays their hand.<br><br>Player actions: The player has several options after receiving their two initial cards:<br>- Hit: The player can request an additional card to increase the value of their hand.<br>- Stand: The player can decide not to take any additional cards and keep their current hand.<br>- Double Down: The player can choose to double their initial bet and receive only one additional card.<br>- Split: If the player's first two cards have the same value, they can choose to split them into two separate hands and place an equal bet on each hand. The player can then play each hand individually.<br><br>Hand values: The value of a hand is the sum of the values of all the cards it contains. If the value of the hand exceeds 21, it is called a 'bust', and the player automatically loses their bet.<br><br>Dealer action: Once all players have played, it is the dealer's turn to play. The dealer follows a predetermined rule called the 'dealer's rule.' Generally, the dealer draws additional cards as long as the value of their hand is less than 17, then they stop.<br><br>Game results: Once the dealer has finished playing, the results are determined:<br>- If the value of the player's hand is closer to 21 than the dealer's without exceeding 21, the player wins and receives a payout equal to their bet.<br>- If the value of the dealer's hand exceeds 21, all remaining players automatically win.<br>- If the value of the player's hand is lower than the dealer's or if the player exceeds 21, the player loses their bet.<br><br>Blackjack: If a player's first two cards are an ace and a card worth 10 (10, jack, queen, or king), the player has a 'blackjack'. A blackjack is usually paid at a rate of 3 times their initial bet in addition to their bet.<br><br>In case of victory, the player receives double their initial bet.",
    btnFermer: "Close",
    sentence_victory: "Congratulations, you've won! 🎉 🎉 🔥 ",
    sentence_loss: "Sorry, you lose! 😪 victory will come another time 🔥",
    sentence_equal: "A tie!, You win your bet back! 🙃🙂",
    title_popup: "End of the game"
};

// Sélectionner les traductions en fonction de la langue  
if (userLanguage === "fr") {
    translations = translationsFr;
} else if (userLanguage === "en") {
    translations = translationsEn;
} else {
    translations = translationsEn;
}

// Modifier le contenue de la page
if(titleElement != null) {
    var titleElement = document.getElementById("title");
    titleElement.textContent = translations.title;
}

if(hitElement != null) {
    var hitElement = document.getElementById("hit");
    hitElement.textContent = translations.hit;
}

if(standElement != null) {
    var standElement = document.getElementById("stand")
    standElement.textContent = translations.stand
}

if(startElement != null) {
    var startElement = document.getElementById("start")
    startElement.textContent = translations.start
}

if(ruleElement != null) {
    var ruleElement = document.getElementById("rule")
    ruleElement.textContent = translations.rule
}

var pointsPlayer = translations.pointsPlayer
    
var pointsCroupier = translations.pointsCroupier

/*Rule*/
var title2Element = document.getElementById("title2")
title2Element.textContent = translations.title2

var titleRuleElement = document.getElementById("titleRule")
titleRuleElement.textContent = translations.titleRule

var titleH2Element = document.getElementById("titleH2")
titleH2Element.textContent = translations.titleH2

var ruleElement = document.getElementById("rule")
ruleElement.textContent = translations.rule

/*Pop Up*/
function popUp(isVictory) {
    if(isVictory === 1) {
        var sentence_popupElement = document.getElementById("sentence-popup")
        sentence_popupElement.textContent = translations.sentence_victory
    } else if(isVictory === 2){
        var sentence_popupElement = document.getElementById("sentence-popup")
        sentence_popupElement.textContent = translations.sentence_loss
    } else {
        var sentence_popupElement = document.getElementById("sentence-popup")
        sentence_popupElement.textContent = translations.sentence_equal
    }

    var h2_popupElement = document.getElementById("h2-popup")
    h2_popupElement.textContent = translations.title_popup

    var btnFermerElement = document.getElementById("btnFermer")
    btnFermerElement.textContent = translations.btnFermer
}