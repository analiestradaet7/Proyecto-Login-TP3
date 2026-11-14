const form = document.getElementById("formLogin");
const correo = document.getElementById("correo");
const password = document.getElementById("password");
const errorCorreo = document.getElementById("errorCorreo");
const errorPassword = document.getElementById("errorPassword");

form.addEventListener("submit", function (e) {
    let valido = true;

    // Limpiar mensajes anteriores
    errorCorreo.textContent = "";
    errorPassword.textContent = "";
    correo.classList.remove("invalido");
    password.classList.remove("invalido");

    // Validar correo
    const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (correo.value.trim() === "") {
        errorCorreo.textContent = "El correo es obligatorio.";
        correo.classList.add("invalido");
        valido = false;
    } else if (!regexCorreo.test(correo.value.trim())) {
        errorCorreo.textContent = "Ingresá un correo válido.";
        correo.classList.add("invalido");
        valido = false;
    }

    // Validar contraseña
    if (password.value === "") {
        errorPassword.textContent = "La contraseña es obligatoria.";
        password.classList.add("invalido");
        valido = false;
    } else if (password.value.length < 8) {
        errorPassword.textContent = "La contraseña debe tener mínimo 8 caracteres.";
        password.classList.add("invalido");
        valido = false;
    }

    // Si hay errores, no se envía el formulario
    if (!valido) {
        e.preventDefault();
    }
});