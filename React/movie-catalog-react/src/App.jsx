import { useState, useEffect } from 'react'
import './App.css'

function App() {
  const [peliculas, setPeliculas] = useState([]);
  const [busqueda, setBusqueda] = useState("Marvel");

  useEffect(() => {
    fetch(`https://www.omdbapi.com/?s=${busqueda}&apikey=39a068c1`)
      .then(response => response.json())
      .then(data => {
        if (data.Response === "True") {
          setPeliculas(data.Search);
        }else{
          setPeliculas([])
        }
      })
      .catch(error => console.error("Error:", error));
  }, [busqueda]);

return ( 
    <div className="contenedorGeneral">
      <div className="contenedorBuscador">
        <div className="buscador">
          <input 
            type="text" 
            value={busqueda} 
            onChange={(e) => setBusqueda(e.target.value)} 
          />
        </div>
      </div>

      {peliculas.length > 0 ? (
        <div className="contenedorPeliculas">
          {peliculas.map(peli => (
            <div key={peli.imdbID} className="tarjetaPelicula">
              <img src={peli.Poster} alt={peli.Title} />
              <div className="infoPelicula">
                <h3>{peli.Title}</h3>
                <p>Año: {peli.Year}</p>
                <span>{peli.Type}</span>
              </div>
            </div>
          ))}
        </div>
      ) : (
        <div>
          <p>No se han encontrado peliculas</p>
        </div>
      )} 
    </div>
  );
}

export default App;