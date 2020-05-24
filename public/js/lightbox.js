const smalltjes= document.querySelectorAll('.small');
const bigtjes= document.querySelectorAll('.big');

//de Nodelist bigtjes in array stoppen(div).

const alleBig =[]

for(let i=0; i<bigtjes.length; i++){
    alleBig.push(bigtjes[i]);

    //element uit de DOM verwijderen.

     bigtjes[i].remove();
}
const sluitknop = document.createElement('i');
sluitknop.className = 'fas fa-times-circle sk';
sluitknop.addEventListener('click', sluiten);


function box(nummer){
    //modaall element maken
    let modaall = document.createElement('div');
    modaall.id = 'modaall';
    modaall.addEventListener('click', sluiten);
    let inhoud = document.createElement('div');
    //modaall inhoud element maken
    inhoud.className = 'modaallInhoud';
    inhoud.innerHTML = alleBig[nummer].innerHTML;
    inhoud.addEventListener('click', function(e){
    e.stopPropagation();
    });

    gsap.to(inhoud, {marginTop: 0, duration: 1, ease: "steps(12)"});
    modaall.append(inhoud);
    inhoud.prepend(sluitknop);
    document.body.append(modaall);

    // var test = document.createElement('h1');
    // test.innerHTML = 'MD!A';
    // document.body.append(test);
}

// klik gebeurtenis op de small div's
for (let i=0; i<smalltjes.length; i++){
    smalltjes[i].addEventListener('click', function() {
    box(i)
    
});
}
function sluiten(){
    document.getElementById('modaall').remove();
}