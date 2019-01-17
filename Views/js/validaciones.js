




/*FUNCIONES PARA VALIDAR LOS FORMULARIOS

comprobarVacio(campo) 
comprobarTexto(campo, size)
comprobarExpresionRegular(campo, exprreg, size)
comprobarAlfabetico(campo, size) 
comprobarEntero(campo, valormenor, valormayor) 
comprobarReal(campo, numero decimales, valormenor, valormayor)
comprobarDni(campo)
comprobarTelf(campo) // teléfono español, tanto nacional como internacional

*/

function comprobarVacio(campo) { //Comprueba si es vacio

	var valor = document.getElementById(campo).value; //Coje el valor del input

	if (valor == "") {
		document.getElementById(campo).style.borderColor = "red"; //pinta el input de rojo
		return false;
	}
	document.getElementById(campo).borderColor = "green"; //pinta el input de verde
	return true;

}

function comprobarTexto(campo, size) { //Comrpueba si es texto

	var expr = /^([^\s\t]+)+$/; //Expresion regular permite todo menos espacios tabuladores etc..
	

	if (comprobarExpresionRegular(campo, expr, size)) { //Comprobamos la expresion regular

		document.getElementById(campo).style.borderColor = "green"; //pinta el input de verde
		return true;
	}
	document.getElementById(campo).style.borderColor = "red"; //pinta el input de rojo
	return false;

}

function comprobarExpresionRegular(campo, exprreg, size) { //Comprueba si el valor de un input coincide con la expresion regular y el length de el campo es menor que el size

	var valor = document.getElementById(campo).value; //Coje el valor del input



	if (comprobarVacio(campo) && exprreg.test(valor) && valor.length <= size) { // Comprueba si es vacio, la expresion y el size
		return true;
	}
	return false;

}

function comprobarAlfabetico(campo, size) {//Comprueba si es solo letras de nuestro alfabeto

	var expr = /^([a-zñáéíóúA-ZÁÉÍÓÚ]+[\s]*)+$/; //Expresion regular permite letras minusculas y mayusculas y espacios entre ellas

	if (comprobarExpresionRegular(campo, expr, size)) { //Comprobamos la expresion regular
		document.getElementById(campo).style.borderColor = "green"; //pinta el input de verde
		return true;
	}
	document.getElementById(campo).style.borderColor = "red"; //pinta el input de rojo


	return false;

}

function comprobarEntero(campo, valormenor, valormayor) { //Comprueba si el valor del input es un entero y está entre esos dos valores

	var expr = /^[0-9]+$/; //Expresion regular permite enteros
	var valor = document.getElementById(campo).value; //Coje el valor del input


	if (valor >= valormenor && valor <= valormayor && expr.test(valor)) { //Comprobamos que la variable sea aceptada por la expresion y que su tamaño esté entre los marcados
		document.getElementById(campo).style.borderColor = "green"; //pinta el input de verde
		return true;
	} else {//Si la variable no coincide con la Expresion regular o el tamaño excede el size
		document.getElementById(campo).style.borderColor = "red"; //pinta el input de rojo
		return false;
	}
}
function comprobarReal(campo, numeros_decimales, valormenor, valormayor) { //Comprueba si el valor del input es un real y está entre esos dos valores y tiene tantos numeros decimales como la variable numerosdecimales


	var expr = "^[0-9]*.[0-9]{1," + numeros_decimales + "}$"; 
	var expr2 = new RegExp(expr); //Creamos una expresion regular con la variable anterior que es un real
	var valor = document.getElementById(campo).value; //Coje el valor del input


	if (valor >= valormenor && valor <= valormayor && expr2.test(valor)) { // Comprobamos que la variable sea aceptada y esté entre los valores
		document.getElementById(campo).style.borderColor = "green"; //pinta el input de verde
		return true;
	}
	document.getElementById(campo).style.borderColor = "red"; //pinta el input de rojo
	return false;

}
function comprobarDni(campo, size) { //Comprobamos si el campo es un dni

	var valor = document.getElementById(campo).value; //Coje el valor del input
	var expr = /^\d{8}[a-zA-Z]?$/ //Expresion regular que permite 8 enteros y puede meter o no la letra
	var numero;
	var modulo;
	var letra = 'TRWAGMYFPDXBNJZSQVHLCKET'; //Sirve para calcular la letra que tienes a partir de los numeros
	var letraIntroducida;
	if (comprobarExpresionRegular(campo, expr, size)) { //Comprobamos que cumple la expresion regular
		if (valor.length == 8) { //Si solo mete numeros calculamos la letra
			numero = valor.substr(0, valor.length);
			modulo = numero % 23;
			letra = letra.substring(modulo, modulo + 1);
			valor = valor + letra;

			document.getElementById(campo).value = valor;

		}
		else { // Comprobamos que la letra coincide
			numero = valor.substr(0, valor.length - 1);
			letraIntroducida = valor.substr(valor.length - 1, valor.length);
			modulo = numero % 23;
			letra = letra.substring(modulo, modulo + 1);
			if (letraIntroducida.toUpperCase() != letra) {// Si no coincide la letra
				document.getElementById(campo).style.borderColor = "red"; //pinta el input de rojo
				return false;
			}
		}
		document.getElementById(campo).style.borderColor = "green"; //pinta el input de verde
		return true;
	}
	document.getElementById(campo).style.borderColor = "red";  //pinta el input de rojo
	return false;

}
function comprobarTelf(campo){ //Comprobamos que sea un número del telefono
	var valor = document.getElementById(campo).value; //Guardamos la variable recibida con id=campo
    var expr = /^(\+34|0034|34)?[\s|\-|\.]?[6|7|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}$/; //Expresión regular para los telefonos nacionales e internacionales en españa
    
     if(expr.test(valor)){ //Comprobamos si el valor se corresponde con la expresion regular
        document.getElementById(campo).style.borderColor="green"; //pinta el input de verde
        return true;
       }else{//Si la variable no coincide con la expresion regular
        document.getElementById(campo).style.borderColor="red"; //pinta el input de rojo
           return false;
       }
}

function comprobarEmail(campo, size) { //Comprobamos que sea un email
    
    var valor = document.getElementById(campo).value; //Guardamos la variable recibida con id=campo
    var expr = /^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/; //Expresión regular para los correos electronicos
    
    if(comprobarExpresionRegular(campo, expr, size)){ //Comprobamos si el valor se corresponde con la ER
        document.getElementById(campo).style.borderColor="green"; //pinta el input de verde
        return true;
       }else{//Si la variable no coincide con la expresion regular
        document.getElementById(campo).style.borderColor="red"; //pinta el input de rojo
           return false;
       }
    
}

function editar(){ //Confirmamos nuevamente si todo esta OK
	if(comprobarEmail("emailEdit",50) && comprobarDni("dniEdit",9) && comprobarVacio("direccionEdit")&& comprobarVacio("avatarEdit") &&   comprobarAlfabetico("nombreEdit",25) && comprobarAlfabetico("apellidosEdit",50) && comprobarVacio("contraseñaEdit")){
		return true;
	}
	alert('Error al editar');
	return false;
}
function registro(){ //Confirmamos nuevamente si todo esta OK
	if(comprobarEmail("email",50) && comprobarDni("DNI",9) && comprobarVacio("direccion")&& comprobarVacio("avatar") &&   comprobarAlfabetico("nombre",25) && comprobarAlfabetico("apellidos",50) && comprobarVacio("login") && comprobarVacio("contraseña")){
		return true;
	}
	alert('Error al editar');
	return false;
}




function validateFileNotEmpty(campo){//validacion de si el resguardo está vacio;
	if(document.getElementById(campo).files.length == 0){
		
		return false;
	}else{
		
		return true;
	}
}

function comprobarPuja(campo,minIncremento,pujaMaxima){
	document.getElementById("pujaboton").disabled=true;
	var valor = document.getElementById(campo).value;
	if(valor < minIncremento+pujaMaxima){
		document.getElementById(campo).style.borderColor="red"; //pinta el input de rojo
		return false;
	}else{
		document.getElementById("pujaboton").disabled=false;
		document.getElementById(campo).style.borderColor="green"; //pinta el input de rojo
		return true;
	}
}


function añadirSubasta(){
	if(validateFileNotEmpty("informacion") && comprobarEntero("incremento", 0, 1000000000) && comprobarVacio("fech_inicio") &&  comprobarVacio("fech_fin") && fechaInicioMayor("fech_inicio","fech_fin")){
		return true;
	}else{
		alert('Error');
		return false;
	}
}
function editSubasta(){
	if(comprobarEntero("incremento", 0, 1000000000) && comprobarVacio("fech_inicio") &&  comprobarVacio("fech_fin") && fechaInicioMayor("fech_inicio","fech_fin")){
		return true;
	}else{
		alert('Error');
		return false;
	}
}

function fechaInicioMayor(fecha1,fecha2){
	var fechaCom1 = document.getElementById(fecha1).value;
	var fechaCom2 = document.getElementById(fecha2).value;

	var data1 = new Date(fechaCom1);
	var data2 = new Date(fechaCom2);
	if(data1 > data2)
	{
		document.getElementById(fecha1).style.borderColor="red"; //pinta el input de rojo
		document.getElementById(fecha2).style.borderColor="red"; //pinta el input de rojo
		return false;
	}
	return true;
}