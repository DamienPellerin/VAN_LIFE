let agencieBtn = document.querySelectorAll('.agencieBtn');
let departureDate = document.querySelector('#departure');
let returnDate = document.querySelector('#return');
let vehicle = document.querySelector('#vehicle');

agencieBtn.forEach(element => {
    element.addEventListener('click', (e) => {
        if (departureDate.value != '' || returnDate.value != '') {
            window.location = `/controllers/recapCtrl.php?agencie=${element.id}&vehicle=${vehicle.value}&departure=${departureDate.value}&return=${returnDate.value}`;
        }
    })
})
