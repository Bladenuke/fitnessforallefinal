// Innlogging
document.getElementById('fitness-login-form')?.addEventListener('submit', async function (e) {
    e.preventDefault();

    const username = document.getElementById('login-username').value;
    const password = document.getElementById('login-password').value;

    try {
        const response = await fetch('https://api.fitnessforalle.no/wp-json/fitness/v1/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, password }),
        });

        const data = await response.json();
        if (response.ok) {
            alert('Innlogging vellykket!');
            localStorage.setItem('fitnessToken', data.token);
            window.location.href = data.user.role === 'admin'
                ? 'https://admin.fitnessforalle.no'
                : 'https://mobil.fitnessforalle.no';
        } else {
            document.getElementById('login-message').textContent = data.error;
        }
    } catch (error) {
        console.error(error);
    }
});

// Registrering
document.getElementById('fitness-register-form')?.addEventListener('submit', async function (e) {
    e.preventDefault();

    const username = document.getElementById('register-username').value;
    const email = document.getElementById('register-email').value;
    const password = document.getElementById('register-password').value;

    try {
        const response = await fetch('https://api.fitnessforalle.no/wp-json/fitness/v1/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ username, email, password }),
        });

        const data = await response.json();
        if (response.ok) {
            alert('Registrering vellykket! Du kan nå logge inn.');
            window.location.href = '/logg-inn';
        } else {
            document.getElementById('register-message').textContent = data.error;
        }
    } catch (error) {
        console.error(error);
    }
});
