var icon = document.getElementById("icon");

icon.onclick = function() {
  if (document.body.classList.contains("dark-theme")) {
    document.body.classList.remove("dark-theme");
    icon.src = "frontend/public/imagens/geral/lua.png";
    localStorage.setItem("theme", "light");
  } else {
    document.body.classList.add("dark-theme");
    icon.src = "frontend/public/imagens/geral/sol.png";
    localStorage.setItem("theme", "dark");
  }
}

window.onload = function() {
  var theme = localStorage.getItem("theme");
  if (theme === "dark") {
    document.body.classList.add("dark-theme");
    icon.src = "frontend/public/imagens/geral/sol.png";
  } else {
    document.body.classList.remove("dark-theme");
    icon.src = "frontend/public/imagens/geral/lua.png";
  }
}