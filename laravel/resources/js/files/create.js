// Load our customized validationjs library
import Validator from '../validator'
 
// Submit form ONLY when validation is OK
const form = document.getElementById("create")
 
form.addEventListener("submit", function( event ) {
   // Reset errors messages
   // ...
   document.getElementById('error').innerHTML = "";
   document.getElementById('error').classList.remove('show');
   // Create validation
   let data = {
       "upload": document.getElementsByName("upload")[0].value,
   }
   let rules = {
       "upload": "required",
   }
   let validation = new Validator(data, rules)
   // Validate fields
   if (validation.passes()) {
    // Allow submit form (do nothing)
    console.log("Validation OK")
} else {
    // Get error messages
    let errors = validation.errors.all()
    console.log(errors)
    // Show error messages
    document.getElementById('error').classList.add('show');
    for(let inputName in errors) {
        // ...
        if (currentLocale == 'ca'){
            document.getElementById('error').innerHTML =  'El camp '+inputName+' es obligatori';
        }
        if (currentLocale == 'es'){
            document.getElementById('error').innerHTML =  'El campo '+inputName+' es obligatorio';
        }
        if (currentLocale == 'en'){
            document.getElementById('error').innerHTML =  'The '+inputName+' field is required';
        }
    }
    // Avoid submit
    event.preventDefault()
    return false
}
})
