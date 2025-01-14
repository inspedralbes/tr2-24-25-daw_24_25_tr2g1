const express = require("express");
const { createServer } = require("node:http");
const { join } = require("node:path");
const { Server } = require("socket.io");
const cors = require("cors");

const app = express();
const server = createServer(app);
// const io = new Server(server);

// const io = new Server(server, {
//   cors: {
//     origin: "http://localhost:5173",
//     methods: ["GET", "POST"],
//   },
// });

const io = new Server(server, {
  cors: {
    origin: "http://alumnet.daw.inspedralbes.cat",
    methods: ["GET", "POST"],
    allowedHeaders: ["Content-Type"],
    credentials: true
  },
});

app.use(cors({
  origin: "http://alumnet.daw.inspedralbes.cat",
  methods: ["GET", "POST"],
  allowedHeaders: ["Content-Type"],
  credentials: true
}));

io.on("connection", (socket) => {
  console.log("Un usuario se ha conectado amb id:", socket.id);

  // Escuchar mensajes del cliente
  socket.on("send-message", (message) => {
    console.log("Mensaje enviado de:", message);
    io.emit("receive-message", message, socket.id); // Emitir el mensaje a todos los clientes
  });

  socket.on("disconnect", () => {
    console.log("El usuario", socket.id, "se ha desconectado");
  });
});

// server.listen(3000, () => {
//   console.log("Servidor escuchando en puerto 3000");
// });

server.listen(21333, () => {
  console.log("Servidor escuchando en puerto 21333");
});