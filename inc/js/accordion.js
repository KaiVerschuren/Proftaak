document.querySelectorAll('.accordion-header').forEach(header => {
    header.addEventListener('click', () => {
        const content = header.nextElementSibling;

        // Toggle the active class for transition
        content.classList.toggle('active');

        // Toggle the max-height for smooth transition
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + 'px';
        }

        // Close other sections
        document.querySelectorAll('.accordion-content').forEach(otherContent => {
            if (otherContent !== content) {
                otherContent.classList.remove('active');
                otherContent.style.maxHeight = null;
            }
        });
    });
});