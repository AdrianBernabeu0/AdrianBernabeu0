import { useState, useEffect } from 'react'
import './App.css'

function App() {
  const [peliculas, setPeliculas] = useState([]);

  useEffect(() => {
    fetch("https://www.omdbapi.com/?s=Marvel&apikey=39a068c1")
      .then(response => response.json())
      .then(data => {
          setPeliculas(data.Search);
      })
      .catch(error => console.error("Error:", error));
  }, []);

  return (
    <div>      
      <div>
        {peliculas.map(peli => (
          <div>
            <img 
              src={peli.Poster}/>
            <div>
              <h3>{peli.Title}</h3>
              <p>Año: {peli.Year}</p>
              <span>{peli.Type}</span>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

export default App;