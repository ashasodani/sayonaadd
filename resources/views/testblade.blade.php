<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Display Country State City using Google API</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Address:</label>
    <div class="col-sm-8">        
 <input type="text" id="ownPlaces" name="ownPlaces" />
 <input type="text" id="ownCity" name="ownCity" placeholder="Own City" />
        <input type="text" id="ownState" name="ownState" placeholder="Own State" />
 <input type="text" id="ownCountry" name="ownCountry" placeholder="Own Country" />        
    </div>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
google.maps.event.addDomListener(window, 'load', function () 
{
   var places = new google.maps.places.Autocomplete(document.getElementById('ownPlaces'));
   google.maps.event.addListener(places, 'place_changed', function () 
   {
 console.log(places.getPlace());
 var getaddress = places.getPlace();
 //alert(getaddress.address_components[0].long_name);
 //alert(getaddress.formatted_address);
 var whole_address           = getaddress.formatted_address;
 var split_whole_address     = whole_address.split(','); 
 //alert(split_whole_address);
 var whole_address_length    = split_whole_address.length;
 //alert(whole_address_length);
 
 if(whole_address_length == 2)
 {
           var ownCity    = split_whole_address[0]; //alert(ownCity+'ownCity');
    	   var ownState   = split_whole_address[0]; //alert(ownState+'ownState');
    	   var ownCountry = split_whole_address[1]; //alert(ownCountry+'ownCountry');
     
    	   $('#ownCity').val(ownCity);
           $('#ownState').val(ownState);
    	   $('#ownCountry').val(ownCountry);
 }
 else
 {
    var ownCity    = split_whole_address[0]; //alert(ownCity+'ownCity');
           var ownState   = split_whole_address[1]; //alert(ownState+'ownState');
    	   var ownCountry = split_whole_address[2]; //alert(ownCountry+'ownCountry');
     
    	   $('#ownCity').val(ownCity);
    	   $('#ownState').val(ownState);
    	   $('#ownCountry').val(ownCountry);
 }
    });
});
</script>