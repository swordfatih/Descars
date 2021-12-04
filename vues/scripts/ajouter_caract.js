var input_count = 0;

function ajouter() {
    let storage = document.getElementById('storage');

    let div = document.createElement('div');
    div.className = "pair";
    div.id = "pair_" + input_count;

    let input = document.createElement('input');
    input.type = "text";
    input.placeholder = 'Nom';
    input.required = true;
    div.appendChild(input);

    input = document.createElement('input'); 
    input.type = "text";
    input.placeholder = 'Valeur';
    input.required = true;
    div.appendChild(input);

    let bouton = document.createElement('span');
    bouton.setAttribute('onclick', `retirer(${input_count})`);
    bouton.innerHTML = '❌';
    div.appendChild(bouton);

    storage.appendChild(div);

    input_count++;
}

function retirer(id) {
    document.getElementById("pair_" + id).remove();
}

function concatener() {
    let pairs = document.getElementsByClassName('pair');

    let object = new Object();

    for(let pair of pairs) {
        let inputs = pair.getElementsByTagName('input');

        object[inputs[0].value] = inputs[1].value;
    }

    document.getElementById('caract').value = JSON.stringify(object);
    console.log(document.getElementById('caract').value);
}