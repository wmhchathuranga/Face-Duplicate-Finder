document.getElementById('myForm').addEventListener('submit', function (event) {
  event.preventDefault();

  const url = document.getElementById('urlInput').value;
  const action = document.getElementById('actionInput').value;
  const namespace = document.getElementById('namespace1').value;

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'http://127.0.0.1/api.php  ', true);
  let data = new FormData();
  data.append('action', action);
  data.append('image', url);
  data.append('namespace', namespace);

  xhr.onreadystatechange = function () {

    let table = document.getElementById('matching-table');
    if (table.querySelector('#matching-table-body'))
      table.querySelector('#matching-table-body').remove();

    let tableBody = document.createElement('tbody');
    tableBody.id = "matching-table-body";
    let imgPreview = document.getElementById('img-preview');
    imgPreview.setAttribute('src', '');

    if (xhr.readyState == 4 && xhr.status == 200) {
      imgPreview.setAttribute('src', url)
      const response = JSON.parse(xhr.responseText);

      if (response.recognized) {
        let confidence = response.confidence;
        confidence.forEach(element => {
          row = document.createElement('tr');
          td1 = document.createElement('td');
          td1.innerText = element.uid;
          td2 = document.createElement('td');
          td2.innerText = element.matching;
          row.appendChild(td1);
          row.appendChild(td2);
          tableBody.appendChild(row);
        });

        table.appendChild(tableBody);
        table.classList.remove('d-none');
        condition = true
        formChanger(condition)
      }
      else {
        table.classList.add('d-none');
        condition = false
        formChanger(condition)
        document.getElementById('tid').value = response.tid;
      }
    }
  };

  xhr.send(data);

});
document.getElementById('myForm2').addEventListener('submit', function (event) {
  event.preventDefault();

  const uidTag = document.getElementById('uid-tag').value;
  const action = document.getElementById('actionTrain').value;
  const tid = document.getElementById('tid').value;
  const namespace = document.getElementById('namespace2').value;

  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'http://127.0.0.1/api.php  ', true);
  let data = new FormData();
  data.append('action', action);
  data.append('tag', uidTag);
  data.append('tid', tid);
  data.append('namespace', namespace);

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      const response = JSON.parse(xhr.responseText);
      if (response.status) {
        document.getElementById('success-msg').innerText = "User Trained!";
        document.getElementById('myForm2').classList.add('d-none');
        setTimeout(() => {
          window.location.reload();
        }, 3000);
      }
    }
  };

  xhr.send(data);

});

function formChanger(condition) {

  const conditionalContent = document.getElementById('conditionalContent');
  const alternateContent = document.getElementById('alternateContent');
  const myForm = document.getElementById('myForm2');

  if (condition) {
    conditionalContent.classList.remove('d-none');
    conditionalContent.classList.add('show');
    alternateContent.classList.add('d-none');
    alternateContent.classList.remove('show');
    myForm.classList.add('d-none');
  } else {
    alternateContent.classList.remove('d-none');
    alternateContent.classList.add('show');
    conditionalContent.classList.add('d-none');
    conditionalContent.classList.remove('show');
    myForm.classList.remove('d-none');
    myForm.classList.add('d-flex');
  }

}
