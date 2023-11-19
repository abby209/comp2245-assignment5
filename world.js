document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('lookupCountry').addEventListener('click', function () {
        lookup('countries');
    });

    document.getElementById('lookupCities').addEventListener('click', function () {
        lookup('cities');
    });

    function lookup(type) {
        const input = document.getElementById('country').value;
        const url = `world.php?type=${type}&name=${input}`;

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
