setInterval(() => {
    fetch('/ajax/get_prices.php')
      .then(response => response.json())
      .then(data => {
        let html = '';
        data.forEach(c => {
          html += `<li>${c.nom} (${c.symbole}) : ${c.prix} $</li>`;
        });
        document.getElementById("crypto-list").innerHTML = html;
      });
  }, 5000);
  