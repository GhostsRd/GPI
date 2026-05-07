const fs = require('fs');

// Fix peri.css
let peri = fs.readFileSync('public/css/peri.css', 'utf8');
peri = peri.replace(/border: 1px solid var\(--border\);/g, 'border: none;');
peri = peri.replace(/border: 1px solid var\(--primary-light\);/g, 'border: none;');
peri = peri.replace(/border: 1px solid var\(--primary-100\);/g, 'border: none;');
peri = peri.replace(/border-color: var\(--primary-light\);/g, '');
peri = peri.replace(/border: 1\.5px solid var\(--border\);/g, 'border: none;');
fs.writeFileSync('public/css/peri.css', peri);
console.log('peri.css updated');

// Fix cssticket.css
let ticket = fs.readFileSync('public/css/cssticket.css', 'utf8');
ticket = ticket.replace(/border: 1px solid var\(--primary-light\);/g, 'border: none;');
ticket = ticket.replace(/border: 1px solid var\(--border\);/g, 'border: none;');
fs.writeFileSync('public/css/cssticket.css', ticket);
console.log('cssticket.css updated');

console.log('Done!');
