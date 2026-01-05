import { useState } from "react";

function FormularioEvento({ alAñadir }) { 
  const [nuevoNombre, setNuevoNombre] = useState("");

  const enviarForm = (e) => {
    e.preventDefault();
    if (nuevoNombre.trim() === "") return;
    
    alAñadir(nuevoNombre);
    setNuevoNombre("");
  };

  return (
    <form onSubmit={enviarForm}>
      <input
        type="text"
        value={nuevoNombre}
        onChange={(e) => setNuevoNombre(e.target.value)}
        placeholder="Escribe un evento..."
      />
      <button type="submit">Añadir</button>
    </form>
  );
}

export default FormularioEvento;