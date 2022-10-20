jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
}, "Letters only please"); 

jQuery.validator.addMethod("capitalonly", function(value, element) {
  return /^[A-Z]+$/.test(value);
}, "Capital Letters only please"); 

