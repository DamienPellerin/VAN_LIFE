document.querySelector('#zipcode').addEventListener('input', function () {
    if (this.value.length == 5) {
        let url = `https://geo.api.gouv.fr/communes?codePostal=${this.value}&fields=nom,code,codesPostaux,codeDepartement,codeRegion,population&format=json&geometry=centre`;
        fetch(url).then((response) => 
        response.json().then((data) => {
            console.log(data);
           let affichage = '<select>';
            for (let city of data) {
                affichage += `<option>${city.nom}</option>`;
            }
            affichage += '</select>';
            document.querySelector('#city').innerHTML += affichage;

            })
        );
    }
});