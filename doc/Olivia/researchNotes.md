**JavaScript and JQuery**
- Enables dynamic content, interactive features, and complex animation on web pages
- JQuery is a small, fast JavaScript library to simplify HTML document traversal and manipulation, event handling, and animation. It can be used for things such as adding animations, handling events, simplifying AJAX calls, etc.

**Links**
- https://www.w3schools.com/jquery/default.asp
- https://api.jquery.com/
- https://www.geeksforgeeks.org/difference-between-javascript-and-jquery/
- https://www.youtube.com/watch?v=JjIvF0yikGU

**Example of JS using JQuery:**

```javascript
$(document).ready(function() {
  $('#get-courses').click(function() {
    $.ajax({
      url: 'https://cis3760f23-09.socs.uoguelph.ca/index.php',
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        $('#display-div').html(data.content);
      },
      error: function(xhr, status, error) {
        $('#display-div').html("An error occurred: " + error);
      }
    });
  });
});
```

In this example, when the button with the label "get-courses" is clicked, an AJAX Get request is made to the URL. It retrieves data and displays it in the div. 

