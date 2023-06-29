function checkEmail(email) {
  const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return regex.test(email);
}
function checkPassword(password) {
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()])[a-zA-Z\d!?§.;,:-_|<>°^@#+~€$%^&*()]{8,}$/;
  console.log(regex.test(password));
  return regex.test(password);
}
function isNumber(input) {
  return !isNaN(input);
}