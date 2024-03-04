const estilPresentacio = document.getElementById('estilPresentacio');
const confirmarSeleccio = document.querySelector('.confirmarSeleccio');
const formEstils = document.getElementById('formEstils');
const contenidorWarning = document.querySelector('.contenidorWarning');
const estilDark = document.querySelector('.dark');
const estilBlue = document.querySelector('.blue');

estilDark.addEventListener('click', (e) => {
  if (contenidorWarning.style.display === 'block') {
    contenidorWarning.style.display = 'none';
  }
  estilPresentacio.value = 'dark';
  estilDark.style.border = '3px solid #FF51FF';
  estilBlue.style.border = '3px solid black';
})

estilBlue.addEventListener('click', (e) => {
  if (contenidorWarning.style.display === 'block') {
    contenidorWarning.style.display = 'none';
  }
  estilPresentacio.value = 'blue';
  estilBlue.style.border = '3px solid #FF51FF';
  estilDark.style.border = '3px solid black';
})

confirmarSeleccio.addEventListener('click', (e) => {
  e.preventDefault();
  if (estilPresentacio.value == ""){
    contenidorWarning.style.display = 'block';
  }
  else{
    formEstils.submit();
  }
})