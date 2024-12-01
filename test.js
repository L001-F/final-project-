document.addEventListener("DOMContentLoaded", () => {
    const menuLinks = document.querySelectorAll(".menu a");
    const sections = document.querySelectorAll(".section");

    menuLinks.forEach(link => {
      link.addEventListener("click", () => {
        // Remove active class from all links
        menuLinks.forEach(item => item.classList.remove("active"));

        // Add active class to clicked link
        link.classList.add("active");

        // Hide all sections
        sections.forEach(section => section.classList.remove("active"));

        // Show the selected section
        const target = link.getAttribute("data-section");
        document.getElementById(target).classList.add("active");
      });
    });
  });
  function updateFilters() {
    const date = document.getElementById('end-date').value;
    const type = document.getElementById('document-type').value;
    const year = document.getElementById('academic-year').value;
    const url = new URL(window.location.href);

    // Update or remove the date filter
    if (date) {
        url.searchParams.set('filter_date', date);
    } else {
        url.searchParams.delete('filter_date');
    }

    // Update or remove the document type filter
    if (type && type !== 'toutes') {
        url.searchParams.set('filter_type', type);
    } else {
        url.searchParams.delete('filter_type');
    }

    // Update or remove the academic year filter
    if (year && year !== 'toutes') {
        url.searchParams.set('filter_year', year);
    } else {
        url.searchParams.delete('filter_year');
    }

    // Reload the page with the updated URL
    window.location.href = url.toString();
}


        // Function to show the clicked section
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => section.classList.remove('active'));
            document.getElementById(sectionId).classList.add('active');
            // Save the current section in localStorage
            localStorage.setItem('activeSection', sectionId);
        }
   // Function to show a specific section
   function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => {
        section.classList.remove('active');
        if (section.id === sectionId) {
            section.classList.add('active');
        }
    });
    // Save the active section to localStorage
    localStorage.setItem('activeSection', sectionId);
}

// Handle clicks on sidebar items to switch sections
document.querySelectorAll('.sidebar .menu a').forEach(item => {
    item.addEventListener('click', function(event) {
        const sectionId = event.target.getAttribute('data-section');
        showSection(sectionId);
    });
});
// Define showSection to display sections based on the saved section
function showSection(sectionId) {
    const sections = document.querySelectorAll('.section'); // Assuming all sections have the class 'section'
    sections.forEach(section => {
        section.style.display = (section.id === sectionId) ? 'block' : 'none';
    });
}

// Restore the saved section on page load
window.addEventListener('load', function() {
    const savedSection = localStorage.getItem('activeSection');
    if (savedSection) {
        showSection(savedSection); // Activate the saved section
    } else {
        // Default to home if no section is saved
        showSection('dashboard');
    }

    // Restore scroll position
    const scrollPosition = localStorage.getItem('scrollPosition');
    if (scrollPosition) {
        window.scrollTo(0, parseInt(scrollPosition, 10));
    }
});

// Save scroll position before the page is unloaded
window.addEventListener('beforeunload', function() {
    localStorage.setItem('scrollPosition', window.scrollY);
});

// Search functionality
document.getElementById('searchButton').addEventListener('click', () => {
    const searchTerm = document.getElementById('searchStudent').value.toLowerCase();
    const rows = document.querySelectorAll('#studentTableBody tr');
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Confirm delete student
function confirmDelete(studentId) {
    if (confirm("Are you sure you want to delete this student?")) {
        window.location.href = "delete_student.php?id=" + studentId; // Redirect to delete script
    }
}

// Optional: You can also add event listeners for activating sections when a menu item is clicked
document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', function() {
        const sectionId = this.dataset.sectionId;
        localStorage.setItem('activeSection', sectionId); // Save the active section
        showSection(sectionId); // Show the active section
    });
});
