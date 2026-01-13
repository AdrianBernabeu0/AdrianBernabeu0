import { useState, useEffect } from 'react'
import './App.css'

function App() {
  const [eventos, setEventos] = useState([]);
  const [nuevoNombre, setNuevoNombre] = useState("");

  useEffect(() => {
    fetch("http://localhost:3001/eventos")
      .then(response => response.json())
      .then(data => setEventos(data))
  }, []);

  const añadirEvento = () => {
    const nuevoEvento = {
      nombre: nuevoNombre,
      vip: false,
    };

    fetch("http://localhost:3001/eventos", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(nuevoEvento),
    })
    .then((response) => response.json()) 
    .then((data) => {
      setEventos([...eventos, data]);
      setNuevoNombre("");
    })
    .catch((error) => console.error("Error al añadir: ", error))
  }

  return (
    <div>
      <h1>Lista de Eventos desde Docker</h1>
      
      <div style={{ marginBottom: "20px" }}>
        <input 
          type="text" 
          value={nuevoNombre} 
          onChange={(e) => setNuevoNombre(e.target.value)} 
          placeholder="Nombre del evento..."
        />
        <button onClick={añadirEvento}>Añadir Evento</button>
      </div>

      <div>
        {eventos.map(evento => (
          <p>
            {evento.nombre} {evento.vip ? "⭐" : ""}
          </p>
        ))}
      </div>
    </div>
  );
}

export default App;