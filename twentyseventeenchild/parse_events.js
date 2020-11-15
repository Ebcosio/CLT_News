
function parseEvents(eventsJson){


	var display = document.getElementById("events-display");
		console.log(eventsJson);
	
	if(eventsJson.hasOwnProperty('error')){
	    var message = document.createElement("P");
		message.classList.add('error-message');
		message.innerText = eventsJson.message; 
		display.appendChild(message);
	   
	   }
	else {
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
			 
			 
			 var button = document.createElement('BUTTON');
			 button.classList.add('accordion');
			 button.innerText = 'Description and Objectives';
			 display.appendChild(button);
			 
			 var panel = document.createElement('DIV');
			 panel.classList.add('panel-hidden');
			 panel.innerHTML = event.description; 
			 panel.style.display = 'none';
			 display.appendChild(panel);
			
		 }
		 
	 });  // ends foreach method
	 activateAccordions();
	} // ends else statment
}

function activateAccordions(){
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
   // this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

}

/*
<button class="accordion">Section 1</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Section 2</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>

<button class="accordion">Section 3</button>
<div class="panel">
  <p>Lorem ipsum...</p>
</div>  */
