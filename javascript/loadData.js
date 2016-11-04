
   function loadData(){
    var tableBody = document.getElementById('data');
    for(var counter = 1; counter<=20; counter++){
        tableBody.innerHTML += '<tr><td class = "counter" id= "counter">'+counter+'</td><td id="name">Omaar</td><td id="ID">213110174</td><td id ="infoA'+counter+'">+966552968296</td><td id="infoB'+counter+'">Omar@example.com</td></tr>';
    }
  }

    function study() {
        document.getElementById('contactNumberColumn').id = "majorColumn";
        document.getElementById('emailColumn').id = "gpaColumn";
        var majorColumn = document.getElementById('majorColumn');
        var gpaColumn = document.getElementById('gpaColumn');
        majorColumn.innerHTML = "major";
        gpaColumn.innerHTML = "GPA";
        for (var counter = 1; counter <= 20; counter++) {
            var infoA = document.getElementById('infoA' + counter);
            var infoB = document.getElementById('infoB' + counter);
            infoA.innerHTML = "3.5";
            infoB.innerHTML = "CS";
        }
        document.getElementById('studyModeBtn').setAttribute('Hidden','Hidden');
        document.getElementById('contactModeBtn').removeAttribute('Hidden');
    }
    function contact(){
      document.getElementById('majorColumn').id = "contactNumberColumn";
      document.getElementById('gpaColumn').id = "emailColumn";
      var contactNumberColumn = document.getElementById('contactNumberColumn');
      var contactNumber = document.getElementById('emailColumn');  
      contactNumberColumn.innerHTML = "Contact Number";
      emailColumn.innerHTML = "E-mail";
      for (var counter = 1; counter <= 20; counter++ ){
      var infoA = document.getElementById('infoA'+counter);
      var infoB = document.getElementById('infoB'+counter); 
      infoA.innerHTML = "example@hotmail.com";
      infoB.innerHTML = "+966552968296";
    }
      document.getElementById('studyModeBtn').removeAttribute('Hidden');contactModeBtn
      document.getElementById('contactModeBtn').setAttribute('Hidden','Hidden');
         
  }