import { useState } from "react";
import Evento from "./FormularioEvento";

function App() {
  const listaInicial = [
    { id: 1, nombre: "Concierto Rock", vip: true },
    { id: 2, nombre: "Feria de DAW", vip: false },
    { id: 3, nombre: "Cena de Empresa", vip: true },
  ];

  const [eventos, setEventos] = useState(listaInicial);

  const eliminarEvento = (id) => {
    const nuevaLista = eventos.filter((evento) => evento.id !== id);
    setEventos(nuevaLista);
  };
  const añadirEvento = (nombreRecibido) => {
    const nuevoEvento = {
      id: Date.now(),
      nombre: nombreRecibido,
      vip: false,
    };
    setEventos([...eventos, nuevoEvento]);
  };

  return (
    <div style={{ padding: "20px" }}>
      <h1>📅 Gestión de Eventos</h1>
      <Evento alAñadir={añadirEvento} />{" "}
      {eventos.map((evento) => (
        <div
          key={evento.id}
          style={{ border: "1px solid #ccc", margin: "10px", padding: "10px" }}
        >
          <span>
            {evento.nombre} {evento.vip ? "⭐" : ""}
          </span>
          <button onClick={() => eliminarEvento(evento.id)}>Eliminar</button>
        </div>
      ))}
    </div>
  );
}

export default App;
