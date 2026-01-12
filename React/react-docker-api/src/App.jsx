import { useState, useEffect } from 'react'
import './App.css'

function App() {
  const [eventos, setEventos] = useState([]);

  useEffect(() => {
    fetch("http://localhost:3001/eventos")
      .then(response => response.json())
      .then(data => setEventos(data))
  }, []);

  return (
    <div>
      <h1>Lista de Eventos desde Docker</h1>
      
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