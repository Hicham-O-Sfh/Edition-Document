function ajaxFonctionCall(form,path) {
 $.ajax(
     {
      url:  path ,
      method: "post",
      dataType: 'json',
      enctype: 'multipart/form-data',
      cache: false,
      processData: false,
      data: form,
      contentType: false,
      error: function (err) {
        console.log(err)
      },
      success: function (data) {
          var data = $.parseJSON(data[0]);

          if (!data.error){


          console.log("retourned data", data);

          var row = " <tr><td></td>"
             +" <td>"+data.fonction +"</td>"
             +" <td>"+data.affectation+"</td>"
             +" <td>"+data.datedebut.date+"</td>"
             +" <td>"+data.datefin.date+"</td>"
             +" <td>A faire</td>"
             +"<td>"+data.observation+"</td> </tr>";


          $("#fonctionTable tr:last").after(row);

          $("#fonctionmodalclose").click();}
          else
          {
              alert("des champs a remplir !!")
          }
      },
      complete: function () {





      }

     });


}

$("#fonctioncomfirm").click(function () {





  var form = new FormData();

   var affecattionid = $('#affectationselect').children('option:selected')[0].value;
   var fonctionid = $('#fonctionselect').children('option:selected')[0].value;
    var datedebut = $('#datedebut')[0].value;
    var datefin = $('#datefin')[0].value;
    var observation = $('#observation')[0].value;
    var userid = $('#useridfonction')[0].value;
    var path = $('#newpath').val();


  form.append('affecattionid', affecattionid);
  form.append('fonctionid', fonctionid);
  form.append('datedebut', datedebut);
  form.append('datefin', datefin);
  form.append('observation', observation);
  form.append('userid', userid);

    ajaxFonctionCall(form,path);




});