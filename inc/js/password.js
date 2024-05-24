document.addEventListener("DOMContentLoaded", function() {
    const showPasswordSvg = document.querySelector('.loginShowPasswordSvg');
    const passwordInput = document.querySelector('.loginPassword');

    showPasswordSvg.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('.loginForm');

    form.addEventListener('submit', function(event) {
        const passwordInput = document.querySelector('.loginPassword');
        const passwordValue = passwordInput.value.trim();

        if (passwordValue.length < 8) {
            event.preventDefault(); // Prevent form submission
            alert("Password must be at least 8 characters long.");
        }
    });
});