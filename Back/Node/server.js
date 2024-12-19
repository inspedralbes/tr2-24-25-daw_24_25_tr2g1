const express = require("express");
const { createServer } = require("node:http");
const { join } = require("node:path");
const { Server } = require("socket.io");

const app = express();
const server = createServer(app);
const io = new Server(server);

app.get("/", (req, res) => {
  res.sendFile(join(__dirname, "/public/index.html"));
});

io.on("connection", (socket) => {
  socket.on("chat message", (msg) => {
    io.emit("chat message", msg);
    console.log("ID: " + socket.id + "message: " + msg);
  });
});

io.on("connection", (socket) => {
  console.log("Un usuari s'ha conectat amb l'id:p", socket.id);
  socket.on("disconnect", () => {
    console.log("Un usuari s'ha desconectat amb l'id:", socket.id);
  });
});

server.listen(3000, () => {
  console.log("server running at http://localhost:3000");
});
