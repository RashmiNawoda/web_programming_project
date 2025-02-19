document.addEventListener("DOMContentLoaded", function () {
  document.querySelector("form").addEventListener("submit", function (event) {
    let name = document.querySelector("input[name='name']").value.trim();
    let comment = document
      .querySelector("textarea[name='comment']")
      .value.trim();

    // Check if the name field is empty
    if (name === "") {
      alert("Please enter your name.");
      event.preventDefault(); // Stop form submission
    }
    // Check if the comment field is empty
    else if (comment === "") {
      alert("Please enter a review.");
      event.preventDefault();
    }
    // Check if the comment exceeds 500 characters
    else if (comment.length > 500) {
      alert("Review must be under 500 characters.");
      event.preventDefault();
    }
  });
});
