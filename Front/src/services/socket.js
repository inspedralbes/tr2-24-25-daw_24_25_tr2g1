import { io } from "socket.io-client";

const socket = io("http://localhost:3000", {
  autoConnect: false, // Evita que se conecte automáticamente
});

export default socket;