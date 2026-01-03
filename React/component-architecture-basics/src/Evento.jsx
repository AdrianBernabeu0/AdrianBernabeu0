function Evento({ nombre, fecha, lugar, esVIP }) {
  const verificarVIP = (esVIP == true ? "#fff4cc" : "#da3333ff");

  return (
    <div style={{ border: "1px solid blue", margin: "10px", padding: "10px" }}>
      <h2 style={{ backgroundColor: verificarVIP }}>{nombre}</h2>
      <h3>
        {esVIP == true && "⭐ Entrada Premium"}
      </h3>
      <h3 style={{color: "gray"}}>{fecha}, {lugar}</h3>
    </div>
  );
}
export default Evento;
