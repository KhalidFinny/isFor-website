import { BASEURL } from './config.js';

function showAlert(message) {
    const alert = document.getElementById('customAlert');
    const alertMessage = document.getElementById('alertMessage');
    alertMessage.textContent = message;
    alert.classList.add('show');

    setTimeout(() => {
        alert.classList.remove('show');
    }, 3000);
}

document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (!username || !password) {
        showAlert('Please fill in all fields');
        return;
    }

    try {
        const formData = new FormData(this);
        const response = await fetch(`${BASEURL}/login/authentication`, {
            method: 'POST',
            body: formData
        });

        const result = await response.text();

        try {
            // Check if response is JSON (error message)
            const jsonResult = JSON.parse(result);
            if (jsonResult.error) {
                showAlert(jsonResult.error);
            }
        } catch {
            // If not JSON, it's a redirect URL
            window.location.href = result;
        }
    } catch (error) {
        showAlert('An error occurred. Please try again.');
    }
});