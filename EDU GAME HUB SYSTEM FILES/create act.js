const selected = document.querySelector(".selected");
const optionsContainer = document.querySelector(".options-container");

const optionsList = document.querySelectorAll(".option");

selected.addEventListener("click", () => {
  optionsContainer.classList.toggle("active");
});

optionsList.forEach(o => {
  o.addEventListener("click", () => {
    selected.innerHTML = o.querySelector("label").innerHTML;
    optionsContainer.classList.remove("active");
    
  });
});


// JavaScript
document.addEventListener("DOMContentLoaded", function () {
  const subjectDropdown = document.getElementById("subjectDropdown");
  const subjectOptionsContainer = document.querySelector(".options-container");

  subjectDropdown.addEventListener("click", function () {
    subjectOptionsContainer.classList.toggle("active");
  });

  const quarterDropdown = document.getElementById("quarterDropdown");
  const quarterOptionsContainer = document.querySelector(".quarter-options-container");

  quarterDropdown.addEventListener("click", function () {
    quarterOptionsContainer.classList.toggle("active");
  });
});