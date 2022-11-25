// Load our customized validationjs library
import Validator from '../validator'
 
// Submit form ONLY when validation is OK
const form = document.getElementById("create");
form.addEventListener("submit", function( event ) {
   // Reset errors messages
   // ...
   document.querySelector('.error').innerHTML = "";
   document.querySelector('.error').classList.remove('show');
   // Create validation
   let data = {
        "body": document.getElementsByName("pnbody")[0].value,
        "upload": document.getElementsByName("pupload")[0].value,
        "latitude": document.getElementsByName("platitude")[0].value,
        "longitude": document.getElementsByName("plongitude")[0].value,
        "visibility_id": document.getElementsByName("pvisibility_id")[0].value,

   }
   let rules = {
        'body' : 'required',
        'upload' : 'required',
        'latitude' : 'required',
        'longitude' : 'required',
        'visibility_id' : 'required',
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
    for(let inputName in errors) {
        let campo = document.querySelector('#'+inputName)
        campo.querySelector('.error').classList.remove('noshow');
        campo.querySelector('.error').classList.add('show');
        campo.querySelector('.error').innerHTML =  errors[inputName];
    }
    // Avoid submit
    event.preventDefault()
    return false
}
})
