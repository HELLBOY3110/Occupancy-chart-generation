function validateForm() {
  var classroomNumberInput = document.getElementById("ClassroomNumber");
  var classroomNumberValue = classroomNumberInput.value.trim();
  
  // Regular expression pattern to match the required format
  var pattern = /^[A-Z]\d{3}$/;
  
  if (!pattern.test(classroomNumberValue)) {
    alert("Classroom Number should have the format: a capital letter followed by three numbers. E.g., A102, B103, C331");
    classroomNumberInput.focus();
    return false;
  }
  
  return true;
}
