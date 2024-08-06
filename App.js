document.addEventListener("DOMContentLoaded", function() {
    // Simulate loading time
    setTimeout(function() {
        document.getElementById('preloader').style.display = 'none';
        document.getElementById('main-content').style.display = 'block';
    }, 3000);
});

document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const email = formData.get('email');
    const confirmEmail = formData.get('confirmEmail');
    const password = formData.get('password');
    const confirmPassword = formData.get('confirmPassword');

    if (email !== confirmEmail) {
        alert('Emails do not match.');
        return;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return;
    }

    fetch('backend.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => alert('Registration successful: ' + data))
    .catch(error => console.error('Error:', error));
});
