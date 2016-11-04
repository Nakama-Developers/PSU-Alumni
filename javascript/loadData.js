
   function loadData(){
    var tableBody = document.getElementById('data');
    for(var counter = 1; counter<=20; counter++){
        tableBody.innerHTML += '<tr><td class = "counter">'+counter+'</td><td>Omaar</td><td>213110174</td><td>Omar@example.com</td></tr>';
    }
  }