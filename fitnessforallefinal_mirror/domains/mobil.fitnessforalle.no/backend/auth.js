const express = require('express');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');

const router = express.Router();
const users = []; // Midlertidig lagring av brukere (erstatt med database)
const secretKey = 'supersecretkey'; // Bytt til miljøvariabel i produksjon

// Registrering
router.post('/register', async (req, res) => {
    const { username, password } = req.body;

    // Krypter passordet
    const hashedPassword = await bcrypt.hash(password, 10);

    // Lagre bruker
    users.push({ username, password: hashedPassword });
    res.status(201).json({ message: 'Bruker registrert!' });
});

// Innlogging
router.post('/login', async (req, res) => {
    const { username, password } = req.body;

    // Finn bruker
    const user = users.find((u) => u.username === username);
    if (!user) return res.status(401).json({ error: 'Ugyldig brukernavn eller passord' });

    // Sjekk passord
    const isValid = await bcrypt.compare(password, user.password);
    if (!isValid) return res.status(401).json({ error: 'Ugyldig brukernavn eller passord' });

    // Generer JWT
    const token = jwt.sign({ username }, secretKey, { expiresIn: '1h' });
    res.json({ token });
});

// Verifisering
router.get('/verify', (req, res) => {
    const token = req.headers['authorization'];
    if (!token) return res.status(403).json({ error: 'Ingen token oppgitt' });

    try {
        const decoded = jwt.verify(token.split(' ')[1], secretKey);
        res.json({ valid: true, username: decoded.username });
    } catch (err) {
        res.status(401).json({ valid: false, error: 'Ugyldig eller utløpt token' });
    }
});

module.exports = router;
