
   function loadData(){
    var tableBody = document.getElementById('data');
    for(var counter = 0; counter<20; counter++){
        tableBody.innerHTML += "<tr><td>Omar</td><td>213110174</td><td>Omar@example.com</td></tr>";
    }
  }