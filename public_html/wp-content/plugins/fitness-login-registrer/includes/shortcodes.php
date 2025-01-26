<?php
// Kortkode for innloggingsskjema
function fitness_login_form_shortcode() {
    ob_start();
    ?>
    <div class="fitness-form-container">
        <h2>Logg inn</h2>
        <form id="fitness-login-form">
            <input type="text" id="login-username" name="username" placeholder="Brukernavn eller e-post" required />
            <input type="password" id="login-password" name="password" placeholder="Passord" required />
            <button type="submit">Logg inn</button>
        </form>
        <p id="login-message"></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('fitness_login_form', 'fitness_login_form_shortcode');

// Kortkode for registreringsskjema
function fitness_register_form_shortcode() {
    ob_start();
    ?>
    <div class="fitness-form-container">
        <h2>Registrer deg</h2>
        <form id="fitness-register-form">
            <input type="text" id="register-username" name="username" placeholder="Brukernavn" required />
            <input type="email" id="register-email" name="email" placeholder="E-post" required />
            <input type="password" id="register-password" name="password" placeholder="Passord" required />
            <button type="submit">Registrer</button>
        </form>
        <p id="register-message"></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('fitness_register_form', 'fitness_register_form_shortcode');
