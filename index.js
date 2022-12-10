const city = document.querySelector("select");
const button = document.querySelector("#button");

button.addEventListener("click", () => {
  window.location.href = "html/" + city.value + ".html";
});
