const namedropdown = document.getElementById("namedropdown");
const sendButton = document.getElementById("send-btn");
const getStudentNames = async () => {
  return $.ajax({
    url: "getStudents.php?param=studentsInfo",
    type: "GET",
    dataType: "json",
    success: function (data) {},
    error: function (error) {
      console.error("Error:", error);
    },
  });
};
const sendStudentCertificate = async (data) => {
  return $.ajax({
    url: "getStudents.php?param=studentsCertificate",
    type: "GET",
    data: { data: data },
    dataType: "json",
    success: function (data) {
      alert("Success! Your certificate was sent.");
    },
    error: function (error) {
      console.error("Error:", error);
    },
  });
};
getStudentNames().then((data) => {
  data.forEach((studentName) => {
    const option = document.createElement("option");
    option.textContent = studentName.firstname + " " + studentName.lastname;
    option.value = studentName.id;
    namedropdown.appendChild(option);
  });
});
sendButton.addEventListener("click", function () {
  var studentId = namedropdown.value;
  var studentFullName = namedropdown.options[namedropdown.selectedIndex].text;
  var certSubject = quarterSelect.options[quarterSelect.selectedIndex].text;
  var data = {
    studentId: studentId,
    studentFullName: studentFullName,
    certSubject : certSubject,
  };
  sendStudentCertificate(data);
});
