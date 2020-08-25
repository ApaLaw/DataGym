function validaUsuario(f) {
  var ok = true;
  var msg = "Debes:\n";
  var numero;
  var letr;
  var letra;
  var expresion_regular_dni;
  expresion_regular_dni = /^\d{8}[a-zA-Z]$/;
  expresion_regular_correo = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
  expresion_regular_codigo = /^DG7G/;
  if(f.elements["dni"].value == "")
  {
    msg += "- Introducir un DNI\n";
    ok = false;
  }
  
  if(expresion_regular_dni.test (f.elements["dni"].value) == true){
   numero = f.elements["dni"].value.substr(0,8);
   letr = f.elements["dni"].value.substr(8,9);
   numero = numero % 23;
   letra='TRWAGMYFPDXBNJZSQVHLCKET';
   letra=letra.substring(numero,numero+1);
     //msg += letr + '\n' + numero + '\n';

     if (letra!=letr.toUpperCase()) {
       msg += '- DNI erroneo, la letra del DNI no se corresponde\n';
       ok = false
     }
   }else{
     msg += '- DNI erroneo, formato no válido\n';
     ok = false
   }
   
   if(f.elements["correo"].value == ""){
    msg += "- Introducir un correo\n";
    ok = false;
  }
  else if(expresion_regular_correo.test(f.elements["correo"].value) == false){
    msg += '- Correo erroneo, formato no válido\n';
    ok = false
  }
  if(expresion_regular_codigo.test(f.elements["cod_access"].value) == false){
    msg += '- Código erroneo\n';
    ok = false
  }
  if(f.elements["contraseña"].value != f.elements["contraseña_repe"].value){
    msg += '- Las contraseñas no coinciden\n';
    ok = false
  }
  if(f.elements["telefono"].value != ""){
    if(f.elements["telefono"].value.length != 9){
      msg += '- El teléfono no es válido\n';
      ok = false
    }
  }

  if(ok == false)
    alert(msg);
  return ok;
}

function validaContact(f) {
  var ok = true;
  var msg = "Debes:\n";
  expresion_regular_correo = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

  if(f.elements["correo"].value == ""){
    msg += "- Introducir un correo\n";
    ok = false;
  }
  else if(expresion_regular_correo.test(f.elements["correo"].value) == false){
    msg += '- Correo erroneo, formato no válido\n';
    ok = false
  }

  if(f.elements["mensaje"].value == ""){
    msg += "- Introducir un mensaje\n";
    ok = false;
  }


  if(ok == false)
    alert(msg);
  return ok;


}

function validaTecnico(f){
  var ok = true;
  var msg = "Debes:\n";
  expresion_regular_correo = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

  if(f.elements["nombre"].value == ""){
    msg += "- Introducir un nombre\n";
    ok = false;
  }

  if(f.elements["correo"].value == ""){
    msg += "- Introducir un correo\n";
    ok = false;
  }else if(expresion_regular_correo.test(f.elements["correo"].value) == false){
    msg += '- Correo erroneo, formato no válido\n';
    ok = false
  }

  if(f.elements["telefono"].value == ""){
    msg += "- Introducir un teléfono\n";
    ok = false;
  }else if(f.elements["telefono"].value.length != 9){
    msg += '- El teléfono no es válido\n';
    ok = false
  }

  if(ok == false)
    alert(msg);
  return ok;
}

function validaTarifa(f){
  var ok = true;
  var msg = "Debes:\n";

  if(f.elements["nombre_tarifa"].value == ""){
    msg += "- Introducir un nombre de tarifa\n";
    ok = false;
  }

  if(f.elements["precio"].value == ""){
    msg += "- Introducir un precio\n";
    ok = false;
  }else if(f.elements["precio"].value <0){
    msg += "- El precio debe ser mayor igual a 0\n";
    ok = false;
  }

  if(f.elements["duracion"].value == ""){
    msg += "- Introducir una duracion\n";
    ok = false;
  }else if(f.elements["duracion"].value <1){
    msg += "- La duracion debe ser mayor igual a 1\n";
    ok = false;
  }

  if(ok == false)
    alert(msg);
  return ok;
}