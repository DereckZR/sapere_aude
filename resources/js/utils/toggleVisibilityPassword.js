// utils/toggleVisibilityPassword.js

/*
|--------------------------------------------------------------------------
| initToggleVisibilityPassword
| Función para manejar la visibilidad del contenido de la contraseña
|--------------------------------------------------------------------------
*/
export function initToggleVisibilityPassword() {
    const containers = document.querySelectorAll(".input-password__container");

    containers.forEach((element) => {
        const input = element.querySelector(".input-password");
        const button = element.querySelector(".input-password__toggle-btn");
        const icon = element.querySelector(".input-password__toggle-btn>i");

        if (!input || !button) {
            return;
        }

        button.addEventListener("click", (event) => {
            event.preventDefault();

            input.type = input.type === "password" ? "text" : "password";

            icon.classList.toggle("fa-eye");
            icon.classList.toggle("fa-eye-slash");
        });
    });
}
