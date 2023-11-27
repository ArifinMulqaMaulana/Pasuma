// navigation
const toggleBtn = document.querySelector('.toggle_btn')
const toggleBtnIcon = document.querySelector('.toggle_btn i')
const dropDownMenu = document.querySelector('.dropdown_menu')

    toggleBtn.onclick = function() {
        dropDownMenu.classList.toggle('open')
        const isOpen = dropDownMenu.classList.contains('open')

        toggleBtnIcon.classList = isOpen
        ? 'fa-solid fa-xmark'
        : 'fa-solid fa-bars'
    }

// Smooth Scrolling
    document.addEventListener("DOMContentLoaded", function () {
        const links = document.querySelectorAll('.links a');
    
        links.forEach(link => {
            link.addEventListener('click', smoothScroll);
        });
    
        function smoothScroll(e) {
            e.preventDefault();
    
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
    
            window.scrollTo({
                top: targetElement.offsetTop - 60, // Adjusted offset for navigation height
                behavior: 'smooth'
            });
        }
    });

    