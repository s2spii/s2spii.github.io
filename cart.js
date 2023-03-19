const cart = document.getElementById("cart");
const openCart = document.getElementById("cart-open");
const ammoButton = document.getElementById("ammoButton");
const ammoBox = document.getElementById("ammoBox");
const ammoCancel = document.getElementById("ammo-cancel");
const ammoAdd = document.getElementById("ammo-add");
let cartIsOpen = false;

openCart.addEventListener("click", () => {
  if (cartIsOpen) {
    cartIsOpen = false;
    cart.classList.remove("visible");
  } else {
    cartIsOpen = true;
    cart.classList.add("visible");
  }
});

ammoButton.addEventListener("click", () => {
  ammoBox.classList.add("visible");
});
ammoCancel.addEventListener("click", (event) => {
  event.preventDefault();
  ammoBox.classList.remove("visible");
});
ammoAdd.addEventListener("click", () => {
  ammoBox.classList.remove("visible");
});
