<?php
// Registrer REST API-rute for innlogging
function fitness_register_login_route() {
    register_rest_route('fitness/v1', '/login', [
        'methods' => 'POST',
        'callback' => 'fitness_handle_login',
        'permission_callback' => '__return_true',
    ]);
}
add_action('rest_api_init', 'fitness_register_login_route');

// Håndter innlogging og generer JWT-token
function fitness_handle_login(WP_REST_Request $request) {
    // Valider innkommende parametere
    $username = sanitize_text_field($request->get_param('username'));
    $password = sanitize_text_field($request->get_param('password'));

    if (empty($username) || empty($password)) {
        return new WP_REST_Response(['error' => 'Brukernavn og passord må fylles ut.'], 400);
    }

    // Valider brukerens legitimasjon
    $user = wp_authenticate($username, $password);
    if (is_wp_error($user)) {
        return new WP_REST_Response(['error' => 'Ugyldig brukernavn eller passord.'], 401);
    }

    // Hent JWT-nøkkel
    $secret_key = defined('JWT_AUTH_SECRET_KEY') ? JWT_AUTH_SECRET_KEY : 'default_secret_key';

    // Generer JWT-token
    $issued_at = time();
    $expire_at = $issued_at + (DAY_IN_SECONDS * 7); // 7 dager
    $token_data = [
        'iss'  => get_bloginfo('url'),
        'iat'  => $issued_at,
        'exp'  => $expire_at,
        'data' => [
            'user' => [
                'id'    => $user->ID,
                'email' => $user->user_email,
                'role'  => $user->roles[0],
            ],
        ],
    ];

    $token = \Firebase\JWT\JWT::encode($token_data, $secret_key, 'HS256');

    return new WP_REST_Response([
        'token' => $token,
        'user'  => [
            'id'           => $user->ID,
            'email'        => $user->user_email,
            'display_name' => $user->display_name,
            'role'         => $user->roles[0],
        ],
    ], 200);
}

// Registrer REST API-rute for registrering
function fitness_register_user_route() {
    register_rest_route('fitness/v1', '/register', [
        'methods' => 'POST',
        'callback' => 'fitness_handle_register',
        'permission_callback' => '__return_true',
    ]);
}
add_action('rest_api_init', 'fitness_register_user_route');

// Håndter brukerregistrering
function fitness_handle_register(WP_REST_Request $request) {
    // Valider innkommende parametere
    $username = sanitize_text_field($request->get_param('username'));
    $email = sanitize_email($request->get_param('email'));
    $password = $request->get_param('password');

    if (empty($username) || empty($email) || empty($password)) {
        return new WP_REST_Response(['error' => 'Alle felt må fylles ut.'], 400);
    }

    if (!is_email($email)) {
        return new WP_REST_Response(['error' => 'Ugyldig e-postadresse.'], 400);
    }

    // Sjekk om brukernavn eller e-post allerede eksisterer
    if (username_exists($username)) {
        return new WP_REST_Response(['error' => 'Brukernavnet er allerede i bruk.'], 400);
    }

    if (email_exists($email)) {
        return new WP_REST_Response(['error' => 'E-posten er allerede registrert.'], 400);
    }

    // Opprett ny bruker
    $user_id = wp_create_user($username, $password, $email);
    if (is_wp_error($user_id)) {
        return new WP_REST_Response(['error' => $user_id->get_error_message()], 400);
    }

    // Sett standardrolle
    $user = get_user_by('id', $user_id);
    $user->set_role('subscriber');

    return new WP_REST_Response(['success' => 'Konto opprettet.', 'user_id' => $user_id], 201);
}
