let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function () {
  sidebar.classList.toggle("active");
  if (sidebar.classList.contains("active")) {
    sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
  } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
};

const alertBox = document.querySelector("#alert-box");
const alertBoxBtn = document.querySelector("#dissmiss-alert");

alertBoxBtn.addEventListener("click", function (e) {
  e.preventDefault();
  alertBox.classList.add("alert-hidden");
});
