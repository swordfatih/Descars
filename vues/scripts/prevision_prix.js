updatePrix();

document.getElementById('debut').addEventListener('input', function (evt) {
    updatePrix();
});

document.getElementById('fin').addEventListener('input', function (evt) {
    updatePrix();
});

function updatePrix() {
    let inputDebut = document.getElementById('debut');
    let inputFin = document.getElementById('fin');
    let inputPrix = document.getElementById('prix');

    let output = document.getElementById('output');
    output.innerHTML = "";

    let tarif = parseInt(document.getElementById('tarif').innerHTML);

    debut = new Date(Date.parse(inputDebut.value));
    fin = new Date(Date.parse(inputFin.value));

    if(debut < Date.now() || inputDebut.value == "") {
        inputDebut.value = new Date((new Date()).setDate(new Date().getDate() + 1)).toISOString().substring(0, 10);
        debut = new Date(Date.parse(inputDebut.value));

        output.innerHTML = 'Veuillez choisir une date de début postérieure.';
        output.style = "color: #ffb7c5";

    } else if(inputFin.value != "" && fin != null && fin <= debut) {
        inputFin.value = new Date((new Date()).setDate(debut.getDate() + 1)).toISOString().substring(0, 10);
        fin = new Date(Date.parse(inputFin.value));

        output.innerHTML = "La date de fin ne peut pas être avant la date de début.";
        output.style = "color: #ffb7c5";
    } 

    if(inputFin.value != "" && fin != null) {
        const jours = ((fin - debut) / (1000 * 3600 * 24));
        inputPrix.value = (tarif * jours) + "€ pour " + jours + " jours";
    } else {
        inputPrix.value = (tarif * 30) + "€ par mois";
    }
}