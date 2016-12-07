window.onload = function(){
    $("b_xml").onclick = function(){

      new Ajax.Request("books.php",{
          method : "get",
          parameters : { category: getCheckedRadio($$("div#category label input"))},
          onSuccess : showBooks_XML,
          onFailure : ajaxFailed,
          onException : ajaxFailed
      });
    }
    $("b_json").onclick = function(){
      new Ajax.Request("books_json.php",{
          method : "get",
          parameters : { category: getCheckedRadio($$("div#category label input"))},
          onSuccess : showBooks_JSON,
          onFailure : ajaxFailed,
          onException : ajaxFailed
      });
    }
};
function getCheckedRadio(radio_button){
  for(var i=0;i<radio_button.length;i++){
    if(radio_button[i].checked){
      return radio_button[i].value;
    }
  }
  return undefined;
}

function showBooks_XML(ajax) {


  var temp = document.getElementsByTagName("li");
/*
  for( var i =0 ;i < (temp.length)+1; i++){
    $("books").removeChild($("books").firstChild);
  }
*/
  while($("books").hasChildNodes()){
    $("books").removeChild($("books").firstChild);
  }
  var book_s = ajax.responseXML.getElementsByTagName("book");
  for(var i =0 ;i < book_s.length ; i++){
    var category = book_s[i].getAttribute("category");
    var title = book_s[i].getElementsByTagName("title")[0].firstChild.nodeValue;
    var author = book_s[i].getElementsByTagName("author")[0].firstChild.nodeValue;
    var year = book_s[i].getElementsByTagName("year")[0].firstChild.nodeValue;

    var li = document.createElement("li");
    li.innerHTML = title + ", by " + author + " (" + year+") ";
    $("books").appendChild(li);

  }

  //alert(ajax.responseText);
}
function showBooks_JSON(ajax) {
  while($("books").hasChildNodes()){
    $("books").removeChild($("books").firstChild);
  }
  var data = JSON.parse(ajax.responseText);
  for(var i = 0; i < data.books.length; i++){
      var li = document.createElement("li");
      li.innerHTML = data.books[i].title + ", by "+ data.books[i].author + " (" + data.books[i].year + ")";
      $("books").appendChild(li);
  }
  //alert(ajax.responseText);
}
function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText +
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
