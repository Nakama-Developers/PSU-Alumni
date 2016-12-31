
   // sort function
    function sort(selected_option) {
        var counter = 0;
        $.get("php/sort.php", { "sort_type": selected_option }, function (data) {
            var parsed = JSON.parse(data);
            recordsBox.innerHTML = " ";          
            $.each(parsed, function (i, field) {
                if (counter > 40) {
                    return false;
                }
                loadRecords(field['Name'], field['Nationality'], "9999999", field['Email'], i, field['Major'], field['GPA'], field['Graduation_year'], field['Job_title'], field['Current_Company'], field['Coop_Company'], field['Company_size']);
                counter++;
            });
            runRecordsEvents();
        });
    }

    // save after edit function
   /* $(".saveIcon").click(function () {
        $('.open-profile').$('input')
    });*/
 
