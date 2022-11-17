const db = firebase.firestore();

db.collection("product")
  .get()
  .then((result) => {
    result.forEach((doc) => {
      var template = `
      <div class="product">
        <div class="thumbnail" style="background-image: url('${
          doc.data().이미지
        }')">
        </div>
          <div class="flex-grow-1 p-4">
            <h5 class="title"><a href="/detail.html?id=${doc.id}"> ${
        doc.data().제목
      } </a></h5>
            <p class="date">${doc.data().날짜}</p>
            <p class="price">${
              doc
                .data()
                .가격.toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원"
            }</p>
          </div>
      </div>`;
      $("#item_list").append(template);
    });
  });
