document.addEventListener("DOMContentLoaded", function() {
  const header = document.querySelector("header");

  window.addEventListener("scroll", function() {
    if (window.scrollY > 50) { // Change 50 to the desired scroll position
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
});
