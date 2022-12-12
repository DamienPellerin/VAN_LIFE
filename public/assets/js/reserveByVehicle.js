let vehicleBtn = document.querySelectorAll('.vehicleBtn');
let departureDate = document.querySelector('#departure');
let returnDate = document.querySelector('#return');
let agencie = document.querySelector('#agencie');

vehicleBtn.forEach(element => {
    element.addEventListener('click', (e) => {
        if (departureDate.value != '' || returnDate.value != '') {
            window.location = `/controllers/recapCtrl.php?vehicle=${element.id}&agencie=${agencie.value}&departure=${departureDate.value}&return=${returnDate.value}`;
        }
    })
})