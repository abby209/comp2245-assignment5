document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('lookup').addEventListener('click', function () {
        const country = document.getElementById('country').value;

        fetch(`world.php?country=${country}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('result').innerHTML = formatData(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });

    function formatData(data) {
        let resultHTML = '<ul>';
        data.forEach(entry => {
            resultHTML += `<li>${entry.name} is ruled by ${entry.head_of_state}</li>`;
        });
        resultHTML += '</ul>';
        return resultHTML;
    }
});
