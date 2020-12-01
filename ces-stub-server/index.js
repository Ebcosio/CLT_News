const express = require('express');
const fs = require('fs');
const bunyan = require('bunyan')
const bunyanMiddleware = require('bunyan-middleware')

const logger = bunyan.createLogger({ name: 'My App' })

const app = express();

app.use(bunyanMiddleware({
  logger: logger
}));

app.get('/fail', (req, res, next) => {
  // next();
  res.status(500).send('<html><head></head><body><p>You broke it.</p></body></html>')
});

function success(req, res) {
  const safeJSON = JSON.parse(fs.readFileSync('./events.json', 'utf8'));
  req.log.info('YO DAWG!')
  res.send(safeJSON);
}

app.get('/', success);
app.get('/success', success);
app.get('/events/json', success);

app.get('/unsafe', (req, res) => {
  const unsafeJSON = JSON.parse(fs.readFileSync('./events-xss.json', 'utf8'));
  res.send(unsafeJSON)
})

const port = process.env.PORT || 3232;
const host = process.env.HOST || 'localhost';
app.listen(port, () => {
  console.log(`App listing at http://${host}:${port}`);
});

