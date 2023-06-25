const scheduleLink = document.getElementById("schedule-link");
const tiketLink = document.getElementById("tiket-link");

const scheduleContent = document.getElementById("schedule-content");
const mainContent = document.getElementById("main-content");
const tiketsContent = document.getElementById("tikets-content");

function evalScripts(container) {
  const scripts = container.getElementsByTagName("script");
  for (let i = 0; i < scripts.length; i++) {
    eval(scripts[i].innerText);
  }
}

function loadCity() {
  return fetch("http://localhost:8080/city.php")
    .then((response) => response.json())
    .catch(function (error) {
      console.log("Error loading city file:", error);
    });
}

scheduleLink.addEventListener("click", function (event) {
  function generateHeder(cityName, headerRow) {
    let th = document.createElement("th");
    th.textContent = `время отправления из г. ${cityName}`;
    headerRow.appendChild(th);

    let th1 = document.createElement("th");
    th1.textContent = `время прибытия на конечный пункт`;
    headerRow.appendChild(th1);

    let th2 = document.createElement("th");
    th2.textContent = `Направление движения автобусов и основные промежуточные пункты`;
    headerRow.appendChild(th2);

    let th3 = document.createElement("th");
    th3.textContent = `время отправления с конечного пункта`;
    headerRow.appendChild(th3);

    let th4 = document.createElement("th");
    th4.textContent = `время прибытия в г. ${cityName}`;
    headerRow.appendChild(th4);
  }

  function generateTable(data) {
    const table = document.createElement("table");
    table.className = "table table-bordered table-striped";
    table.id = `${data.name}${data.id}`;
    table.style.display = "none";

    const thead = document.createElement("thead");
    thead.className = "thead-dark";

    const headerRow = document.createElement("tr");
    generateHeder(data.name, headerRow);

    thead.appendChild(headerRow);

    table.appendChild(thead);

    const tbody = document.createElement("tbody");

    data.schedule.forEach((item) => {
      const row = document.createElement("tr");

      Object.entries(item).forEach(([key, value]) => {
        if (key !== "id" && key !== "city_id") {
          const td = document.createElement("td");
          td.textContent = value;
          row.appendChild(td);
        }
      });

      tbody.appendChild(row);
    });

    table.appendChild(tbody);

    return table;
  }

  function distributor(cityName, id) {
    const container = document.getElementById("container-tables");

    // Iterate over the children of the container
    Array.from(container.children).forEach((table) => {
      // Do something with each child element
      if (table.id === `${cityName}${id}`) {
        table.style.display = "block";
      } else {
        table.style.display = "none";
      }
    });
    // tables.forEach((table) => {
    //   if (table.id === `${cityName}${id}`) {
    //     table.style.display = "block";
    //   } else {
    //     table.style.display = "none";
    //   }
    // });
  }

  function generateSideBar(city) {
    const sidebar = document.getElementById("sidebar");
    let sidebarMenu = document.createElement("ul");
    sidebarMenu.className = "side-menu";

    city.forEach((item) => {
      let li = document.createElement("li");
      li.className = "area-item";

      link = document.createElement("a");
      link.textContent = item.name;
      link.addEventListener("click", () => distributor(item.name, item.id));

      li.appendChild(link);
      sidebarMenu.appendChild(li);
    });
    sidebar.appendChild(sidebarMenu);
  }

  loadCity()
    .then(function (data) {
      var city = data;
      fetch("http://localhost:80/schedule.html")
        .then(function (response) {
          return response.text();
        })
        .then(function (data) {
          scheduleContent.innerHTML = data;
          mainContent.style.display = "none";
          tiketsContent.style.display = "none";
          // evalScripts(scheduleContent);
          const containerTables = document.getElementById("container-tables");
          generateSideBar(city);

          console.log(containerTables);
          city.forEach((item) => {
            containerTables.appendChild(generateTable(item));
          });

          let firstChile = containerTables.children[0];
          firstChile.style.display = "block";
        })
        .catch(function (error) {
          console.log("Error loading schedule file:", error);
        });
    });  
});

tiketLink.addEventListener("click", function (event) {
  event.preventDefault();

  fetch("http://localhost:80/tikets.html")
    .then(function (response) {
      return response.text();
    })
    .then(function (data) {
      tiketsContent.innerHTML = data;
      scheduleContent.style.display = "none";
      mainContent.style.display = "none";
    })
    .catch(function (error) {
      console.log("Error loading schedule file:", error);
    });
});
