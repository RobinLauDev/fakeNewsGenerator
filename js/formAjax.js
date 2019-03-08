    //this script chooses a random form format via their ID names, shows that div via jquery show() css function en hides the other ones
    //form ID's into an array, so they can be manipulated later via the array names and jquery get element by ID
    var inputsArray = ["hobby", "favThing"];
    var arrayLength = inputsArray.length;
    var choosenForm = "";

    //choose random array and show it, also hide the other forms in the array
    function switchForms(){
          var returnValue = inputsArray[Math.floor(Math.random() * inputsArray.length)];
          var gekozenform = returnValue;
                for (var i = 0; i < arrayLength; i++) {
                  if((inputsArray[i]) != gekozenform){
                    var arrayValue1 = inputsArray[i];
                    $("." + arrayValue1).hide();
                  }
                  else{
                    choosenForm = inputsArray[i];
                    $("." + choosenForm).show();
                    submitForm();
                  }
              }
    }    
   
   //execute function on doc load
   $(document).ready(function(){
    switchForms();
   });


// jquery ajax form submit
function submitForm(){ 
    var options = { 
        target:        '.imageCont',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback 
    }; 


    $('#'+choosenForm).ajaxForm(options); 

    //listen for enter press and prevents default instant form submit
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
          event.preventDefault();
          $('#'+choosenForm).ajaxSubmit(options);
          $('#'+choosenForm)[0].reset();
          switchForms();
     }
    });

    //listens to generate button click and submits the right form
    //The forms used to have different semantic format outputs, different array structures and php pages, but because we had to pivot the project, now they both go to the same php page
    $(".fakeButton").click(function(){
        $('#'+choosenForm).ajaxSubmit(options);
        $('#'+choosenForm)[0].reset();
        switchForms();
  }); 
}


//these 2 function are needed for the jquery ajax submit
function showRequest(formData, jqForm, options) { 

} 
 
function showResponse(responseText, statusText, xhr, $form)  { 

} 
