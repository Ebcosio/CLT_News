function parseEvents(eventsJson){

//var eventsJson = <?php echo $events  ?> ;
	var display = document.getElementById("events-display");
		console.log(eventsJson);
	 eventsJson.forEach(event => {
		 if(!event.is_event_over){
		  var title = document.createElement("H3");
			 title.classList.add('title-heading');
			 title.innerText = event.title;
			 display.appendChild(title);
			 
			 
			 var location = document.createElement("P");
			 location.innerText = event.location;
			 display.appendChild(location); 
			 
			 var dates = document.createElement("P");
			 dates.innerText = event.event_dates;
			 display.appendChild(dates); 
			 
	         var register = document.createElement("A");
			 register.innerText = "Register for this event";
			 register.classList.add('register-link');
			 register.href = "https://clt.odu.edu/events/" + event.id;
			 register.target = "_blank";
			 display.appendChild(register);
			 
			
		 }
		 
	 });
	 

}
