// Handle Home click separately to reload the page
function handleHomeClick() {
    setActiveLink('home');
    location.reload(); // Reload the page when Home is clicked
}

// Set active link based on user interaction
function setActiveLink(activeLink) {
    const links = document.querySelectorAll(".nav-link");

    // Reset all links to default
    links.forEach(link => {
        link.classList.remove("active");
    });

    // Set the active link based on the argument
    const activeElement = document.querySelector(`.nav-link[onclick="setActiveLink('${activeLink}')"]`);
    if (activeElement) {
        activeElement.classList.add("active");
    } else if (activeLink === 'home') {
        document.getElementById("homeLink").classList.add("active");
    }
}

// Initialize the active link on page load
window.onload = function() {
    setActiveLink('home'); // Set Home as active when the page loads
}

function toggleDropdown() {
    const dropdown = document.querySelector('.dropdown');
    dropdown.classList.toggle('show');
}

// Close the dropdown if clicked outside
window.onclick = function(event) {
    if (!event.target.matches('.dropdown-toggle') && !event.target.closest('.dropdown-toggle')) {
        const dropdown = document.querySelector('.dropdown');
        if (dropdown.classList.contains('show')) {
            dropdown.classList.remove('show');
        }
    }
}

// Toggle sidebar when the hamburger menu is clicked
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.overlay');
    
    sidebar.classList.toggle('translate-x-full');
    overlay.classList.toggle('show');
}

  
// Close sidebar when overlay is clicked
    document.querySelector('.overlay').onclick = function() {
    toggleSidebar();
}