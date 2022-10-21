const tombolCari = document.querySelector(".tombol-cari");
const keyword = document.querySelector(".keyword");
const container = document.querySelector(".container");

keyword.addEventListener("keydown", function () {
  // Ajax

  // XMLHTTPREQUEST
  // const xhr = new XMLHttpRequest();

  // xhr.onreadystatechange = function () {
  //   if (xhr.readyState == 4 && xhr.status == 200) {
  //     container.innerHTML = xhr.responseText;
  //   }
  // };

  // xhr.open("get", "ajax/ajax-cari.php?keyword=" + keyword.value);
  // xhr.send();

  // fetch();
  fetch("ajax/ajax-cari.php?keyword=" + keyword.value)
    .then((response) => response.text())
    .then((response) => (container.innerHTML = response));
});
