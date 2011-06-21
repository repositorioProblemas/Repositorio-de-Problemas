      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(loadAll);
      var places = new Array();
      var charts = new Array();

      function data(preg1,val1,preg2,val2){
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Respuesta');
        data.addColumn('number', 'Total');
        data.addRows(2);
        data.setValue(1, 0, preg1);
        data.setValue(1, 1, val1);
        data.setValue(0, 0, preg2);
        data.setValue(0, 1, val2);
	return data;
      }
	
      function drawChart(where, what) {
	places[places.length] = where;
	charts[charts.length] = what;
      }
      function loadAll(){
	var i;
	for (i =0; i<places.length; i++)
		(new google.visualization.PieChart(document.getElementById(places[i]))).draw(charts[i],{width: 150, height: 150, legend: 'none', fontSize: 12});
      }
      
