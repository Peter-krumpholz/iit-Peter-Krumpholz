/* Lab 5 JavaScript File 
   Place variables and functions in this file */

   function nicknameFunc(formObj){
         var first = document.getElementById("firstName")
         var last = document.getElementById("lastName")
         var nickname = document.getElementById("pseudonym")
         alert(first.value + " " + last.value + " is " + nickname.value);
         return true;
         
   }


   function validate(formObj) {
      // put your validation code here
      // it will be a series of if statements
      var alertString="";
      var focusSet = 0;
      if (formObj.firstName.value == "") {
         alertString+="You must enter a first name\n"
         if (focusSet==0) {
            formObj.firstName.focus();
            focusSet=1;
         }
         
      }
      if (formObj.lastName.value == "") {
         alertString+="You must enter a last name\n";
         if (focusSet==0) {
            formObj.lastName.focus();
            focusSet=1;
         }
        
      }
      if (formObj.title.value == "") {
         alertString+="You must enter a title\n";
         if (focusSet==0) {
            formObj.title.focus();
            focusSet=1;
         }
        
      }
      if (formObj.org.value == "") {
         alertString+="You must enter an organization\n";
         if (focusSet==0) {
            formObj.org.focus();
            focusSet=1;
         }

      }  
      if (formObj.pseudonym.value == "") {
         alertString+="You must enter an nickname\n";
         if (focusSet==0) {
            formObj.pseudonym.focus();
            focusSet=1;
         }
        
      }  
      if (formObj.comments.value == "") {
         alertString+="You must enter comments\n";

         if (focusSet==0) {
            formObj.comments.focus();
            focusSet=1;
         }
      
      }
      if (alertString=="") {
         alert("Valid!");
         return true;      
      }else{
         alert(alertString);
         return false;
      }

   }

function clearBox(formObj){
   var comment = document.getElementById("comments");
   if(comment.value === "Please enter your comments") {
      comment.value = ""; 
   }
   return comment.value;
}
