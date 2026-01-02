import Evento from './Evento';

function App() {
const agenda = [
  { 
    id: 1, 
    nombre: "Concierto de Rock", 
    fecha: "2024-06-15", 
    lugar: "Estadio Metropolitano", 
    esVIP: true 
  },
  { 
    id: 2, 
    nombre: "Feria de Tecnología", 
    fecha: "2024-07-02", 
    lugar: "IFEMA", 
    esVIP: false 
  },
  { 
    id: 3, 
    nombre: "Cena de Gala", 
    fecha: "2024-08-20", 
    lugar: "Hotel Ritz", 
    esVIP: true 
  },
  { 
    id: 4, 
    nombre: "Torneo de Pádel", 
    fecha: "2024-09-10", 
    lugar: "Polideportivo Municipal", 
    esVIP: false 
  },
  { 
    id: 5, 
    nombre: "Festival Jazz", 
    fecha: "2024-10-05", 
    lugar: "Teatro Real", 
    esVIP: true 
  }
];

  return (
    <div>
      <h1>Lista Dinámica</h1>
      
      {agenda.map((user) => (
        <Evento 
          key={user.id} 
          nombre={user.nombre} 
          fecha={user.fecha}
          lugar= {user.lugar}
          esVIP = {user.esVIP}
        />
      ))}
    </div>
  );
}

export default App;