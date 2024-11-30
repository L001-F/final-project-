document.addEventListener('DOMContentLoaded', function () {
    const heroCarousel = new bootstrap.Carousel('#heroCarousel', {
        interval: 5000, // Carousel auto-slide interval
        ride: 'carousel'
    });

    console.log("Hero Carousel initialized!");
});
// Function to handle search

function filterResults() {
    const input = document.getElementById('search').value.toLowerCase();
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';

    if (input) {
        const elements = document.querySelectorAll('body *'); 

        elements.forEach(element => {
            if (element.textContent && element.textContent.toLowerCase().includes(input)) {
                const div = document.createElement('div');
                div.textContent = element.textContent.trim();
                div.onclick = () => {
                    element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    document.getElementById('search').value = element.textContent.trim();
                    localStorage.setItem('searchInput', element.textContent.trim());
                    resultsContainer.innerHTML = '';
                };
                resultsContainer.appendChild(div);
            }
        });
    } else {
        const noResults = document.createElement('div');
        noResults.classList.add('no-results');
        noResults.textContent = 'No results found';
        resultsContainer.appendChild(noResults);
    }

    
}
document.addEventListener('DOMContentLoaded', function () {
    const zoomImage = document.querySelector('.zoom-out-plan');
    const imageModal = document.getElementById('imageModal');
    const closeBtn = document.querySelector('.close-btn');

    // Function to show the modal with full-screen image
    zoomImage.addEventListener('click', function () {
        imageModal.style.display = 'flex'; // Show the modal
    });

    // Function to close the modal when clicking on the 'X' button
    closeBtn.addEventListener('click', function () {
        imageModal.style.display = 'none'; // Hide the modal
    });

    // Close modal if the user clicks outside of the image
    window.addEventListener('click', function (event) {
        if (event.target === imageModal) {
            imageModal.style.display = 'none'; // Hide the modal if clicked outside
        }
    });
});
