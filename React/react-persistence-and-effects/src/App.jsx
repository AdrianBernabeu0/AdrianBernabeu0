import { useState, useEffect } from 'react'
import Evento from "./FormularioEvento";

function App() {
  const listaInicial = [
    { id: 1, nombre: "Concierto Rock", vip: true },
    { id: 2, nombre: "Feria de DAW", vip: false },
    { id: 3, nombre: "Cena de Empresa", vip: true },
  ];

const [eventos, setEventos] = useState(() => {
  const guardados = localStorage.getItem("mis_eventos");
  return guardados ? JSON.parse(guardados) : listaInicial;
});
const [usuario, setUsuario] = useState(() => {
  return localStorage.getItem("nombre_usuario") || "Invitado";
});
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

  const [soloVip, setSoloVip] = useState(false);

  const totalEventos = eventos.length;
  const totalVip = eventos.filter(e => e.vip).length;
  useEffect(() => {
  localStorage.setItem("mis_eventos", JSON.stringify(eventos));
  document.title = `Tienes ${eventos.length} eventos`;}, 
  [eventos]);
  useEffect(() => {
  localStorage.setItem("nombre_usuario", usuario);
}, [usuario]);

  const eventosAMostrar = soloVip 
    ? eventos.filter(e => e.vip) 
    : eventos;

  return (
    <div style={{ padding: "20px" }}>
      <input type="text" value={usuario} onChange={(e) => setUsuario(e.target.value)}
      style={{ border: 'none', background: 'transparent', fontWeight: 'bold', fontSize: '1.2rem' }}/>
      <button onClick={() => setSoloVip(!soloVip)}>
      {soloVip ? "Ver Todos" : "Ver solo VIP ⭐"}
      </button>
      <h1>📅 Gestión de Eventos</h1>
      <div style={{ marginBottom: '20px', color: '#666' }}>
        <p>Total de eventos: <strong>{totalEventos}</strong></p>
        <p>Eventos VIP: <strong>{totalVip}</strong> ⭐</p>
      </div>
      <Evento alAñadir={añadirEvento} />{" "}
      {eventosAMostrar.map((evento) => (
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
