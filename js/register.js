const form = document.getElementById("formRegistro");

const campos = {
    nombre:   { input: document.getElementById("nombre"),   error: document.getElementById("errorNombre") },
    apellido: { input: document.getElementById("apellido"), error: document.getElementById("errorApellido") },
    correo:   { input: document.getElementById("correo"),   error: document.getElementById("errorCorreo") },
    password: { input: document.getElementById("password"), error: document.getElementById("errorPassword") },
    repetir:  { input: document.getElementById("repetir"),  error: document.getElementById("errorRepetir") },
};

function marcarError(campo, mensaje) {
    campos[campo].error.textContent = mensaje;
    campos[campo].input.classList.add("invalido");
}

form.addEventListener("submit", function (e) {
    let valido = true;

    // Limpiar errores anteriores
    for (const c in campos) {
        campos[c].error.textContent = "";
        campos[c].input.classList.remove("invalido");
    }

    const nombre   = campos.nombre.input.value.trim();
    const apellido = campos.apellido.input.value.trim();
    const correo   = campos.correo.input.value.trim();
    const password = campos.password.input.value;
    const repetir  = campos.repetir.input.value;

    if (nombre === "") { marcarError("nombre", "El nombre es obligatorio."); valido = false; }
    if (apellido === "") { marcarError("apellido", "El apellido es obligatorio."); valido = false; }

    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (correo === "") {
        marcarError("correo", "El correo es obligatorio.");
        valido = false;
    } else if (!regexCorreo.test(correo)) {
        marcarError("correo", "Ingresá un correo válido.");
        valido = false;
    }

    const regexPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/;
    if (password === "") {
        marcarError("password", "La contraseña es obligatoria.");
        valido = false;
    } else if (!regexPass.test(password)) {
        marcarError("password", "Mín 8 chars, mayúscula, minúscula, número y símbolo.");
        valido = false;
    }

    if (repetir === "") {
        marcarError("repetir", "Repetí la contraseña.");
        valido = false;
    } else if (password !== repetir) {
        marcarError("repetir", "Las contraseñas no coinciden.");
        valido = false;
    }

    if (!valido) e.preventDefault();
});