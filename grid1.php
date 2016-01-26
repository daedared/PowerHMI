<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="keywords" content="jQuery Gauge, Gauge, Linear Gauge, Vertical Gauge, Horizontal Gauge" />
    <title id='Description'>Power System HMI</title>
    <link rel="stylesheet" href="/assets/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="/assets/jqwidgets/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/scripts/demos.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/jqxexpander.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/jqxgauge.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/jqxradiobutton.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/jqxslider.js"></script>
    <script type="text/javascript" src="/assets/jqwidgets/jqxbuttons.js"></script>
    <link href='assets/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <link href='assets/css/bootstrap-responsive.min.css' rel='stylesheet' type='text/css'>
    <script src='assets/js/bootstrap.min.js' type='text/javascript'></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var majorTicks = { size: '13%', interval: 50 },
                minorTicks = { size: '8%', interval: 10, style: { 'stroke-width': 1, stroke: '#aaaaaa'} },
                labels = { position: 'far',interval: 50 };
            $('#gauge1').jqxLinearGauge({
                orientation: 'vertical',
                labels: labels,
                ticksMajor: majorTicks,
                ticksMinor: minorTicks,
                max: 150,
		min: 0,
                value: 50,
                pointer: { size: '6%' },
                colorScheme: 'scheme05',
            });
            $('#gauge2').jqxLinearGauge({
                orientation: 'vertical',
                labels: labels,
                ticksMajor: majorTicks,
                ticksMinor: minorTicks,
                max: 150,
		min: 0,
                value: 100,
                pointer: { size: '6%' },
                colorScheme: 'scheme05',
            });
            $('#gauge3').jqxLinearGauge({
                orientation: 'vertical',
                labels: labels,
                ticksMajor: majorTicks,
                ticksMinor: minorTicks,
                max: 150,
		min: 0,
                value: 100,
                pointer: { size: '6%' },
                colorScheme: 'scheme05',
            });

		$("#breaker").jqxToggleButton({ toggled: true, template: 'success'});
		$("#breaker2").jqxToggleButton({ toggled: true, template: 'success'});
		
		$("#breaker").on('click', function () {                                                                                                                                       
                var toggled = $("#breaker").jqxToggleButton('toggled');                                                                                                                   
                if (toggled) {                                                                                                                                                            
                	$("#breaker").jqxButton({ template: 'success'});                                                                                                                      
                	$("#breaker")[0].value = 'Closed';
        		var xmlhttp = new XMLHttpRequest();
        		xmlhttp.open("GET", "put_values.php?var=gen1_breaker&value=1&t="+Math.random(), true);
        		xmlhttp.send();
			
                }else {
                        $("#breaker").jqxButton({ template: 'danger'});                                                                                                                       
                        $("#breaker")[0].value = 'Tripped';                                                                                                                                   
        		var xmlhttp = new XMLHttpRequest();
        		xmlhttp.open("GET", "put_values.php?var=gen1_breaker&value=0&t="+Math.random(), true);
        		xmlhttp.send();
                    }                                                                                                                                                                         
                });
		$("#breaker2").on('click', function () {                                                                                                                                       
                var toggled = $("#breaker2").jqxToggleButton('toggled');                                                                                                                   
                if (toggled) {                                                                                                                                                            
                	$("#breaker2").jqxButton({ template: 'success'});                                                                                                                      
                	$("#breaker2")[0].value = 'Closed';
        		var xmlhttp = new XMLHttpRequest();
        		xmlhttp.open("GET", "put_values.php?var=relay1_breaker&value=1&t="+Math.random(), true);
        		xmlhttp.send();
			
                }else {
                        $("#breaker2").jqxButton({ template: 'danger'});                                                                                                                       
                        $("#breaker2")[0].value = 'Tripped';                                                                                                                                   
        		var xmlhttp = new XMLHttpRequest();
        		xmlhttp.open("GET", "put_values.php?var=relay1_breaker&value=0&t="+Math.random(), true);
        		xmlhttp.send();
                    }                                                                                                                                                                         
                });
		$("#update1").jqxButton({});                                                                                 
                $("#update1").on('click', function () {
        	var xmlhttp = new XMLHttpRequest();
		var gen = document.getElementById("generation");
        	xmlhttp.open("GET", "put_values.php?var=gen1_generation&value="+gen.value+"&t="+Math.random(), true);
        	xmlhttp.send();
                });
		$("#up1").jqxButton({});
                $("#up1").on('click', function () {
        	var xmlhttp = new XMLHttpRequest();
		var current_gen = parseFloat(document.getElementById("generation_p").innerHTML)+10;
        	xmlhttp.open("GET", "put_values.php?var=gen1_generation&value="+current_gen+"&t="+Math.random(), true);
        	xmlhttp.send();
                });
		$("#down1").jqxButton({});
                $("#down1").on('click', function () {
        	var xmlhttp = new XMLHttpRequest();
		var current_gen = parseFloat(document.getElementById("generation_p").innerHTML)-10;
        	xmlhttp.open("GET", "put_values.php?var=gen1_generation&value="+current_gen+"&t="+Math.random(), true);
        	xmlhttp.send();
                });

        });
    </script>
    <script>
	setInterval(function(){update();},1000);

	function update(){
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var data = JSON.parse(xmlhttp.responseText);
                //document.getElementById("generation").value = data.generation;
                document.getElementById("generation_p").innerHTML = data.gen1_generation;
                document.getElementById("load").innerHTML = data.relay1_load;
                var relay_breaker = parseInt(data.relay1_breaker);
                var gen_breaker = parseInt(data.gen1_breaker);
		if(gen_breaker == 1){
                	$("#breaker").jqxButton({ template: 'success'});
                	$("#breaker")[0].value = 'Closed';
		}else{
                	$("#breaker").jqxButton({ template: 'danger'});
                	$("#breaker")[0].value = 'Tripped';
		}
		if(relay_breaker == 1){
                	$("#breaker2").jqxButton({ template: 'success'});
                	$("#breaker2")[0].value = 'Closed';
		}else{
                	$("#breaker2").jqxButton({ template: 'danger'});
                	$("#breaker2")[0].value = 'Tripped';
		}
                document.getElementById("flow").innerHTML = data.relay1_flow;
		$('#gauge1').jqxLinearGauge({value: Math.round(data.gen1_generation) });
		$('#gauge2').jqxLinearGauge({value: Math.round(data.relay1_load) });
		$('#gauge3').jqxLinearGauge({value: Math.round(data.relay1_flow) });
                
            }
        }
        xmlhttp.open("GET", "get_values.php", true);
        xmlhttp.send();
}
</script>
    <style type="text/css">
    .demo-options
    {
        list-style: none;
        padding: 0px;
        margin: 10px;
    }
    .demo-options li
    {
        padding: 3px;
        font-family: Verdana;
        font-size: 12px;        
    }
    td{
	background-color: white;
	}
    </style>
</head>

<body class='default' style="background-image: url('back.jpg'); background-size: 100% auto">

      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Power Grid Control Center</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/grid1.php">Grid1</a></li>
              <li><a href="/grid2.php">Grid2</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
	<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-4">
        <div class="demo-gauge">
        	<div id="gauge1" style="margin: 0 auto;"></div>
    	</div>
    	</div>
	<div class="col-md-4 col-sm-4 col-xs-4">
        <div class="demo-gauge">
        	<div id="gauge2" style="margin: 0 auto;"></div>
    	</div>
    	</div>
	<div class="col-md-4 col-sm-4 col-xs-4">
        <div class="demo-gauge">
        	<div id="gauge3" style="margin: 0 auto;"></div>
    	</div>
    	</div>
	</div>
	<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-4">


	<table style="padding-top: 10px; width: 250px; margin: 0 auto;" class="table-bordered">
	<tr>
	<td>
	<p style="text-align: center;">Generation</p>
	</td>
	<td>
	<div style='width:100%;' id='jqxWidget'>
            <div>
                <input style='width: 100%' type="button" value="Inc. by 10" id='up1' \>
            </div>
        </div>

	</td>
	</tr>
	<tr>
	<td>
	<p id="generation_p" style="text-align: center;"></p>
	</td>
	<td>
	<div style='width:100%;' id='jqxWidget'>
            <div>
                <input style='width: 100%' type="button" value="Dec. by 10" id='down1' \>
            </div>
        </div>
	</td>
	</tr>
	<tr>
	<td>
	<div style='width:100%;' id='jqxWidget'>
            <div>
                <input style='width: 100%' type="button" value="Update" id='update1' />
            </div>
        </div>
	</td><td style="background-color: black;"></td>
	<tr>
	<td>
	<input id="generation" style="width: 100%; text-align: center;"></input>
	</td><td style="background-color: black;"></td>
	</tr>
	<tr>
	<td>
	<p style="text-align: center;">Breaker</p>
	</td>
	<td>
        <div style='width:100%;' id='jqxWidget'>
            <div>
                <input style='width:100%;' type="button" value="Closed" id='breaker' />
            </div>
        </div>
	</td>
	</tr>
	</table>


    	</div>
	<div class="col-md-4 col-sm-4 col-xs-4">
	<table style="padding-top: 10px; width: 150px; margin: 0 auto;" class="table-bordered">
	<tr><td>
	<p style="text-align: center;">Load</p>
	</td></tr>
	<tr><td>
	<p id="load" style="text-align: center;">100.0</p>
	</td></tr>
	</table>

    	</div>
	<div class="col-md-4 col-sm-4 col-xs-4">
	<table style="padding-top: 10px; width: 150px; margin: 0 auto;" class="table-bordered">
	<tr><td>
	<p style="text-align: center;">Power Flow</p>
	</td></tr>
	<tr><td>
	<p id="flow" style="text-align: center;">100.0</p>
	</td></tr>
	<tr>
	<td>
	<p style="text-align: center;">Breaker</p>
	</td>
	<td>
        <div style='width:100%;' id='jqxWidget'>
            <div>
                <input style='width:100%;' type="button" value="Closed" id='breaker2' />
            </div>
        </div>
	</td>
	</tr>
	</table>
    	</div>
	</div>


</body>
</html>
