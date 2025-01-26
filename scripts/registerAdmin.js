const mysql = require("mysql2/promise");
const crypto = require("crypto");

// Konfigurasjon for database
const dbConfig = {
  host: "localhost",
  user: "root",
  password: "Wxk7821!",
  database: "fitnessforalle_no_wordpress",
};

// Funksjon for å generere WordPress-hash for passord
function wpHashPassword(password) {
  const salt = crypto.randomBytes(8).toString("base64");
  const hash = crypto
    .createHash("md5")
    .update(salt + password)
    .digest("hex");
  return `$P$B${salt}${hash}`;
}

// Funksjon for å opprette en adminbruker
async function registerAdmin(username, password, email) {
  const connection = await mysql.createConnection(dbConfig);

  try {
    console.log("Kobler til databasen...");

    // Hashe passordet
    const hashedPassword = wpHashPassword(password);

    // Sjekk om brukeren allerede eksisterer
    const [existingUser] = await connection.query(
      "SELECT * FROM wp_users WHERE user_login = ?",
      [username]
    );

    if (existingUser.length > 0) {
      console.log(`Brukeren "${username}" eksisterer allerede.`);
      return;
    }

    // Legg til brukeren i wp_users
    const now = new Date().toISOString().slice(0, 19).replace("T", " ");
    const [userResult] = await connection.query(
      `
      INSERT INTO wp_users (user_login, user_pass, user_nicename, user_email, user_registered, user_status, display_name)
      VALUES (?, ?, ?, ?, ?, ?, ?)
      `,
      [username, hashedPassword, username, email, now, 0, username]
    );

    const userId = userResult.insertId;

    // Legg til rollen administrator i wp_usermeta
    await connection.query(
      `
      INSERT INTO wp_usermeta (user_id, meta_key, meta_value)
      VALUES
        (?, 'wp_capabilities', '{"administrator":"1"}'),
        (?, 'wp_user_level', '10')
      `,
      [userId, userId]
    );

    console.log(`Admin-brukeren "${username}" er opprettet!`);
  } catch (error) {
    console.error("Feil ved oppretting av adminbruker:", error.message);
  } finally {
    await connection.end();
    console.log("Tilkoblingen til databasen er lukket.");
  }
}

// Kjør skriptet
registerAdmin("Ron", "Wxk7821!", "ron@example.com");
