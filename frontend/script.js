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

async function loadCity() {
  return fetch("http://localhost:8080/city.php")
    .then((response) => response.json())
    .catch(function(error) {
      console.log("Error loading city file:", error);
    });
}

async function loadFliht(departure_city_id, arrival_city_id) {
  return fetch(
    `http://localhost:8080/tikets.php?departure_city_id=${departure_city_id}&arrival_city_id=${arrival_city_id}`
  )
    .then((response) => response.json())
    .catch(function(error) {
      console.log("Error loading city file:", error);
    });
}

scheduleLink.addEventListener("click", function(event) {
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

  loadCity().then(function(data) {
    var city = data;
    fetch("http://localhost:80/schedule.html")
      .then(function(response) {
        return response.text();
      })
      .then(function(data) {
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
      .catch(function(error) {
        console.log("Error loading schedule file:", error);
      });
  });
});

tiketLink.addEventListener("click", function(event) {
  event.preventDefault();

  function generateSearchSelectForm(city, name) {
    const fGroup = document.createElement("div");
    fGroup.className = "form-group";
    const select = document.createElement("select");
    select.className = "form-control";
    select.name = name;
    select.id = `select-${name}`;

    const option = document.createElement("option");
    option.value = "";
    if (name === "from") {
      option.textContent = "Выберите откуда";
    } else {
      option.textContent = "Выберите куда";
    }
    select.appendChild(option);

    city.forEach((item) => {
      const option = document.createElement("option");
      option.value = item.id;
      option.textContent = item.name;
      select.appendChild(option);
    });
    fGroup.appendChild(select);
    return fGroup;
  }

  loadCity().then(function(data) {
    var city = data;
    fetch("http://localhost/tikets.html")
      .then(function(response) {
        return response.text();
      })
      .then(function(data) {
        tiketsContent.innerHTML = data;
        scheduleContent.style.display = "none";
        mainContent.style.display = "none";

        const fSearch = document.getElementById("search-form");

        fromGroup = generateSearchSelectForm(city, "from");
        toGroup = generateSearchSelectForm(city, "to");
        fSearch.appendChild(fromGroup);
        fSearch.appendChild(toGroup);

        button = document.createElement("button");
        button.className =
          "btn btn-primary form-control search-button order-button";
        button.textContent = "Найти";
        button.type = "submit";
        button.addEventListener("click", (event) => {
          event.preventDefault();
          const from = document.getElementById("select-from").value;
          const to = document.getElementById("select-to").value;
          console.log(from, to);
          findTikets(from, to);
        });
        fSearch.appendChild(button);
      })
      .catch(function(error) {
        console.log("Error loading schedule file:", error);
      });
  });
});

function generateTiket(
  tiket,
  departureCityName,
  departureTime,
  arrivalCityName,
  arrivalTime,
  price,
  companyName,
  countOfTickets,
) { 
  const tiketElement = document.createElement("div");
  tiketElement.className = "tiket";

  const tiketItems = document.createElement("div");
  tiketItems.className = "tiket-items";
  // Carrier Item
  const carrierItem = document.createElement("div");
  carrierItem.className = "carrier-item";
  const carrierName = document.createElement("div");
  carrierName.className = "carrier-name";
  const carrierSpan = document.createElement("span");
  carrierSpan.className = "title";
  carrierSpan.textContent = companyName;
  carrierName.appendChild(carrierSpan);
  carrierItem.appendChild(carrierName);
  tiketItems.appendChild(carrierItem);
  // Departure
  const departureElement = document.createElement("div");
  departureElement.className = "departure";
  const departureTimeElement = document.createElement("span");
  departureTimeElement.className = "departure-time time";
  departureTimeElement.textContent = departureTime;
  const departureCityNameElement = document.createElement("div");
  departureCityNameElement.className = "start-place";
  departureCityNameElement.textContent = departureCityName;
  departureElement.appendChild(departureTimeElement);
  departureElement.appendChild(departureCityNameElement);
  tiketItems.appendChild(departureElement);
  // Arrival
  const arrivalElement = document.createElement("div");
  arrivalElement.className = "arrival";
  const arrivalTimeElement = document.createElement("span");
  arrivalTimeElement.className = "arrival-time time";
  arrivalTimeElement.textContent = arrivalTime;
  const arrivalCityNameElement = document.createElement("div");
  arrivalCityNameElement.className = "end-place";
  arrivalCityNameElement.textContent = arrivalCityName;
  arrivalElement.appendChild(arrivalTimeElement);
  arrivalElement.appendChild(arrivalCityNameElement);
  tiketItems.appendChild(arrivalElement);
  // Price
  const priceElement = document.createElement("div");
  priceElement.className = "price-action-box";
  const priceItems = document.createElement("div");
  priceItems.className = "price-items";
  const priceDefault = document.createElement("div");
  priceDefault.className = "default-price price";
  priceDefault.textContent = price;
  const priceSpan = document.createElement("span");
  priceSpan.className = "gray-text";
  priceSpan.textContent = "за 1 пассажира";
  const freeSeats = document.createElement("div");
  freeSeats.className = "free-seats-many";
  freeSeats.textContent = `Осталось ${countOfTickets}+ мест`;
  priceItems.appendChild(priceDefault);
  priceItems.appendChild(priceSpan);
  priceItems.appendChild(freeSeats);
  priceElement.appendChild(priceItems);
  tiketElement.appendChild(priceElement);
  // Action
}

function findTikets(departureCityId, arrivalCityId) {
  loadFliht(departureCityId, arrivalCityId).then(function(data) {
    var flight = data;
    const ticketsListElement = document.getElementById("ticket-list");
  });
}
