document.addEventListener("DOMContentLoaded", function () {
  // Select only review form
  let reviewForm = document.querySelector(".review-form-container form");

  if (reviewForm) {
    reviewForm.addEventListener("submit", function (event) {
      let name = reviewForm.querySelector("input[name='name']").value.trim();
      let comment = reviewForm
        .querySelector("textarea[name='comment']")
        .value.trim();

      // Check if name is empty
      if (name === "") {
        alert("Please enter your name.");
        event.preventDefault(); // Stop form submission
      }
      // Check if comment is empty
      else if (comment === "") {
        alert("Please enter a review.");
        event.preventDefault();
      }
      // Check if comment cross 500 characters
      else if (comment.length > 500) {
        alert("Review must be under 500 characters.");
        event.preventDefault();
      }
    });
  }
});
