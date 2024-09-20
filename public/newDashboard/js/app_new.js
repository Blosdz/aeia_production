// Toggle de la visibilidad del menú de filtros
document.querySelector(".jsFilter").addEventListener("click", function () {
  document.querySelector(".filter-menu").classList.toggle("active");
});

// Cambio a vista en "Grid"
var gridButton = document.querySelector(".grid");
if (gridButton) {
  gridButton.addEventListener("click", function () {
    document.querySelector(".list").classList.remove("active");
    gridButton.classList.add("active");
    document.querySelector(".products-area-wrapper").classList.add("gridView");
    document.querySelector(".products-area-wrapper").classList.remove("tableView");
  });
}

// Cambio a vista en "Table"
var listButton = document.querySelector(".list");
if (listButton) {
  listButton.addEventListener("click", function () {
    listButton.classList.add("active");
    document.querySelector(".grid").classList.remove("active");
    document.querySelector(".products-area-wrapper").classList.remove("gridView");
    document.querySelector(".products-area-wrapper").classList.add("tableView");
  });
}

// Aplicar filtros al hacer clic en "Apply"
var applyFilterButton = document.getElementById("applyFilter");
if (applyFilterButton) {
  applyFilterButton.addEventListener("click", function () {
    var userType = document.getElementById("userTypeFilter").value;
    var status = document.getElementById("statusFilter").value;

    var params = new URLSearchParams();
    if (userType) params.append('userType', userType);
    if (status) params.append('status', status);

    // Redireccionar con los parámetros de filtro
    window.location.href = "?" + params.toString();
  });
}

// Resetear filtros al hacer clic en "Reset"
var resetFilterButton = document.getElementById("resetFilter");
if (resetFilterButton) {
  resetFilterButton.addEventListener("click", function () {
    // Limpiar selectores
    document.getElementById("userTypeFilter").value = "";
    document.getElementById("statusFilter").value = "";

    // Recargar la página sin parámetros
    window.location.href = window.location.pathname;
  });
}

// Alternar entre modos de luz y oscuridad
var modeSwitch = document.querySelector('.mode-switch');
if (modeSwitch) {
  modeSwitch.addEventListener('click', function () {
    document.documentElement.classList.toggle('light');
    modeSwitch.classList.toggle('active');
  });
}

// Buscar perfiles por nombre o apellido cuando se presiona Enter
var searchBar = document.querySelector(".search-bar");
if (searchBar) {
  searchBar.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {  // Cuando el usuario presiona Enter
      var searchQuery = searchBar.value.trim();  // Obtener el valor de la barra de búsqueda
      var params = new URLSearchParams(window.location.search);  // Obtener los parámetros actuales de la URL

      if (searchQuery) {
        params.set('search', searchQuery);  // Si hay un valor de búsqueda, añadirlo a los parámetros
      } else {
        params.delete('search');  // Si está vacío, eliminar el parámetro 'search'
      }

      window.location.href = "?" + params.toString();  // Redireccionar con los nuevos parámetros
    }
  });
}
