document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('lookupCountry').addEventListener('click', function () {
        lookupCountry();
    });

    function lookupCountry() {
        const input = document.getElementById('country').value;
        const url = `world.php?type=countries&name=${input}`;

        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('result').innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }
});
