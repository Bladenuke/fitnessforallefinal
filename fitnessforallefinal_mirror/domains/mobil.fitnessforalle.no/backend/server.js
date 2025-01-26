const express = require('express');
const bodyParser = require('body-parser');
const authRoutes = require('./auth');

const app = express();
app.use(bodyParser.json());

// Legg til auth-ruter
app.use('/api/auth', authRoutes);

app.listen(3000, () => console.log('API kjører på http://localhost:3000'));
