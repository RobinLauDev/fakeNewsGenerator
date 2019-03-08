//CORS API
//this API bypasses the CORS protocol which prevents the retrieval of data through ajax calls 
  var cors_api_url = 'https://cors-anywhere.herokuapp.com/';
  function doCORSRequest(options, printResult) {
    var x = new XMLHttpRequest();
    x.open(options.method, cors_api_url + options.url);
    x.onload = x.onerror = function() {
      printResult(
        options.method + ' ' + options.url + '\n' +
        x.status + ' ' + x.statusText + '\n\n' +
        (x.responseText || '')
      );
    };
    if (/^POST/i.test(options.method)) {
      x.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }
    x.send(options.data);
  }

// it gets called on doc load
(function() {
  var urlField = "https://www.foxnews.com";
  var dataField = document.getElementById('data');
  var outputField = document.getElementById('output');
    
  window.onload = function call(e) {
    e.preventDefault();
    doCORSRequest({ 
      method: 'GET',
      url: urlField,
      data: dataField.value
    }, 
    function printResult(result) {

      //removes certain parts of the foxnews headline format, so only the headline is left
      $(function() {

        //Remove discriptive part of content
        $(".collection.collection-spotlight").eq( 1 ).find(".content").find(".info").find(".content").css("display", "none");
      });

      //removes the first lines of the ajax called HTML page "Succeeded" method that is backed into the API
      var lines = result.split('\n');

      // remove one line, starting at the first position
      lines.splice(0,2);

      // join the array back into a single string
      var newtext = lines.join('\n');
      outputField.innerHTML = newtext;
    });
  };
})();

