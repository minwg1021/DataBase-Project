const db = firebase.firestore();
number = 1;

db.collection("product")
  .get()
  .then((result) => {
    result.forEach((doc) => {
      var template = `
          <div class="col-lg-4 col-sm-6 mb-4">
            <div class="portfolio-item">
              <a
                class="portfolio-link"
                data-bs-toggle="modal"
                href="#portfolioModal${number}"
              >
                <div class="portfolio-hover">
                  <div class="portfolio-hover-content">
                    <i class="fas fa-plus fa-3x"></i>
                  </div>
                </div>
                <img
                  class="img-fluid"
                  src='${doc.data().이미지}'
                  alt="..."
                  style="width: 350px; height: 350px;"
                />
              </a>
              <div class="portfolio-caption">
                <div class="portfolio-caption-heading">${doc.data().제목}</div>
                  <div class="portfolio-caption-subheading text-muted">
                    ${
                      doc
                        .data()
                        .가격.toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원"
                    }
                  </div>
                </div>
              </div>
            </div>
          </div>`;
      $("#main_product").append(template);

      var template_info = `
          <div
            class="portfolio-modal modal fade"
            id="portfolioModal${number}"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal">
                  <img src="assets/img/close-icon.svg" alt="Close modal" />
                </div>
                <div class="container">
                  <div class="row justify-content-center">
                    <div class="col-lg-8">
                      <div class="modal-body">
                        <h2 class="text-uppercase">${doc.data().제목}</h2>
                        <p class="item-intro text-muted">
                        가격: 
                          ${
                            doc
                              .data()
                              .가격.toString()
                              .replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "원"
                          }
                        </p>
                        <img
                          class="img-fluid d-block mx-auto"
                          src='${doc.data().이미지}'
                          alt="..."
                        />
                        <p>
                         ${doc.data().내용}
                        </p>
                        <button
                          class="btn btn-primary btn-xl text-uppercase"
                          data-bs-dismiss="modal"
                          type="button"
                        >
                          <i class="fas fa-xmark me-1"></i>
                          닫기
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>`;
      $("#main_product_info").append(template_info);
      number++;
    });
  });
