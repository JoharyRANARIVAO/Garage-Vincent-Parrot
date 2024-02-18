console.log('connecté'); 

// Je sélectionne et je stocke
// la DIV switch-box
const switchBox = document.querySelector('.switch-box'); 
console.log(switchBox); 
// la DIV btn (le cercle)
const btnDark = document.querySelector('.btnDark'); 
console.log(btnDark)
// l'icône
const icone = document.querySelector('i'); 
console.log(icone); 
// la DIV container
const body= document.querySelector('body'); 
console.log(body); 
// le titre
const titre = document.querySelector('h1'); 
console.log(titre); 


// Je soumets la DIV switch à une action au clic
switchBox.addEventListener('click', function(){
    console.log('DIV cliquée !'); 

    // Je déplace le cercle
    //btn.style.left = "60px";


    // J'utilise .classList.toggle
    // classList.toggle() permet d'alterner une classe
    btnDark.classList.toggle('btnDark-change'); 
    // Je déplace l'icône
    icone.classList.toggle('icone-change'); 
    // Je change l'icône
    icone.classList.toggle('fa-sun'); 
    // La DIV switch change de couleur de fond
    switchBox.classList.toggle('switch-change');
    // La DIV banniere change de couleur de fond
    body.classList.toggle('body-change'); 

    // Je modifie le texte du titre
    if(titre.innerText === "Mode Sombre"){
        titre.innerText = "Mode Clair"; 
    }else{
        titre.innerText = "Mode Sombre"; 
    }

}); 
