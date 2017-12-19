window.onload = function() {                            // On Window Load
    var inputForm   = document.querySelector('form');   // Select Form
    inputForm.onsubmit = function(e) {                  // Form On Submit
        if (!inputForm.img_to_compress.value) {         // if File Upload Field is Empty   
            e.preventDefault();                         // Pervent Form Submit (Return False)
            alert('Please Select an Image!');           // Alert An Error Message
        }
    }
}