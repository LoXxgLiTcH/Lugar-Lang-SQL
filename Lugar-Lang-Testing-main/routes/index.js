document.getElementById("loadRoutesBtn").addEventListener("click", fetchRoutes);

function fetchRoutes() {
  fetch("jeepney_routes.json")
    .then((res) => {
      if (!res.ok) {
        console.log("Error!");
      }

      return res.json();
    })
    .then((routes) => { displayRoutes(routes)})
    .catch((error) => {
      console.error(
        "There has been a problem with your fetch operation:",
        error
      );
    });
}

function displayRoutes(routes){

  
  routes.forEach(route =>
  {
    const routeItem = `<li>Jeepney Code: ${route.id}</li>`

    document.getElementById('routes').insertAdjacentHTML("beforeend", routeItem);
  }
  );
}
