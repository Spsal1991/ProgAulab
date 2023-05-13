let togglePasswordBtns = document.querySelectorAll(
  ".toggle-password, .toggle-password-confirm"
);

function togglePassword(input, icon) {
  let currentType = input.getAttribute("type");
  if (currentType === "password") {
    input.setAttribute("type", "text");
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  } else if (currentType === "text") {
    input.setAttribute("type", "password");
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  }
}

togglePasswordBtns.forEach((button) => {
  button.addEventListener("mousedown", function (event) {
    event.preventDefault();
    let passwordInput = this.previousElementSibling;
    let passwordIcon = this.querySelector("i");
    togglePassword(passwordInput, passwordIcon);
  });
});
