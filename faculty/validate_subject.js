function validateSubject(subjectCode) {
  // Regular expression pattern to match the subject code
  var pattern = /^19CSE\d{3}$/;

  // Check if the subject code matches the pattern
  if (pattern.test(subjectCode)) {
    return true; // Valid subject code
  } else {
    return false; // Invalid subject code
  }
}
