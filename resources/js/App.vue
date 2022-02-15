<template>
  <div class="app">
    <div class="main-section">
      <div class="container-fluid">
        <div class="row flex-nowrap">
          <div class="col-3" v-for="(column, indexID) in info" :key="indexID">
            <div class="draggable-column">
              <div class="column-header">
                <button
                  class="btn btn-primary add-card-btn"
                  data-target="#myModal"
                  @click="makeNormalModal($event, column)"
                >
                  Add Card
                </button>
                <h2 class="column-title">Column {{ column.id }}</h2>
                <button @click="deleteAllCard(column.id)">
                  <i class="fa fa-times"></i>
                </button>
              </div>

              <!-- teleport target -->
              <div
                class="modal fade"
                id="myModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalLabel"
                ref="modal"
              >
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Add Card</h4>
                    </div>
                    <div class="modal-body">
                      <form>
                        <label>Title</label>
                        <input
                          type="text"
                          v-model="form.title"
                          class="form-control"
                        />

                        <label>Description</label>
                        <input
                          type="text"
                          v-model="form.description"
                          class="form-control"
                        />

                        <input type="hidden" v-model="form.column_id" />
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button
                        type="button"
                        class="btn btn-default"
                        @click="hideModal()"
                      >
                        Close
                      </button>
                      <button
                        type="button"
                        class="btn btn-primary"
                        @click="cardSaveData(this.modalData.id)"
                      >
                        Save changes
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              <draggable
                v-model="column.column_card_data"
                group="people"
                @start="drag = true"
                @end="drag = false"
                item-key="id"
                class="draggable-column--wrap"
              >
                <template #item="{ element }">
                  <div
                    class="draggable-column--wrap--card"
                    data-target="#myModal"
                    @click="
                      makeEditModal($event, element.id, column.column_card_data)
                    "
                  >
                    <h4>ID: {{ element.id }}</h4>
                    <h4>Name: {{ element.title }}</h4>
                    <p>Description: {{ element.description }}</p>
                  </div>
                </template>
              </draggable>

              <!--edit modal-->
              <div
                class="modal fade"
                id="myModalEdit"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalLabel"
                ref="modal"
              >
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">Edit Card</h4>
                    </div>
                    <div class="modal-body">
                      <form>
                        <label>Title</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="title"
                        />

                        <label>Description </label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="description"
                        />

                        <input type="hidden" />
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button
                        type="button"
                        class="btn btn-default"
                        @click="hideEditModal()"
                      >
                        Close
                      </button>
                      <button
                        type="button"
                        class="btn btn-primary"
                        @click="cardUpdateData(cardDataID)"
                      >
                        Update
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!--end -->
            </div>
          </div>
          <div class="col-3">
            <button class="btn btn-success w-100" @click="addColum">
              Add Column
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- <router-view></router-view> -->
  </div>
</template>
<script>
import draggable from "vuedraggable";

export default {
  name: "app",
  components: {
    draggable,
  },
  data() {
    return {
      drag: true,
      addCardModel: false,
      infoID: null,
      info: null,
      cardData: null,
      title: "",
      description: "",
      cardDataID: "",
      form: {
        title: "",
        description: "",
        column_id: "",
      },
      modalData: null,
      modalCardData: null,
    };
  },
  created: function () {
    // console.log(this.info1);
    this.info1;
  },

  methods: {
    hideModal() {
      // this.$refs["my-modal"].hide();
      $("#myModal").modal("hide");
    },
    hideEditModal() {
      $("#myModalEdit").modal("hide");
    },
    deleteAllCard: function (id) {
      axios
        .post("http://127.0.0.1:8000/api/delete/column/" + id)
        .then((response) => {
          // this.responseData = response.data
          console.log("responsedata", response);
          location.reload();
        })
        .catch((error) => {
          console.log("error", error);
        });
    },
    addColum() {
      // alert("colomn add");
      axios
        .post("http://127.0.0.1:8000/api/add/column")
        .then((response) => {
          console.log("data inserted-->", response);
          this.info1 = response;
        })
        .catch((error) => {
          console.log(error);
          // this.errored = true;
        });
      // .finally(() => this.loading = false)
    },
    makeNormalModal(event, column) {
      this.modalData = column.id;
      this.$nextTick(() => {
        this.modalData = column;
      });
      $("#myModal").modal("show");
    },
    makeEditModal(event, id, cardData) {
      axios
        .get("http://127.0.0.1:8000/api/list/particularcolumn/" + id)
        .then((res) => {
          console.log("selected data display-->", res.data.data.id);
          this.title = res.data.data.title;
          this.description = res.data.data.description;
          this.cardDataID = res.data.data.id;
          // $("#myModalEdit").modal("hide");
        })
        .catch((error) => {
          // error.response.status Check status code
        });
      this.$nextTick(() => {
        this.modalCardData = id;
        this.modalCardData = cardData;
      });
      $("#myModalEdit").modal("show");
    },
    cardSaveData: function (column_id) {
      const formData = new FormData();
      formData.append("title", this.form.title);
      formData.append("description", this.form.description);
      formData.append("column_id", column_id);
      axios
        .post("http://127.0.0.1:8000/api/add/card", formData)
        .then((res) => {
          // console.log("card is inserted-->", res);
          $("#myModal").modal("hide");
          location.reload();
        })
        .catch((error) => console.log(error.res.data))
        .finally(() => {
          //Perform action in always
        });
    },
    cardUpdateData: function (column_id) {
      const formData = new FormData();
      formData.append("title", this.title);
      formData.append("description", this.description);
      formData.append("column_id", column_id);
      axios
        .post(
          "http://127.0.0.1:8000/api/edit/particularcolumn/" + column_id,
          formData
        )
        .then((res) => {
          $("#myModalEdit").modal("hide");
          location.reload();
        })
        .catch((error) => {
          // error.response.status Check status code
        });
    },
  },

  mounted() {
    axios
      .get("http://127.0.0.1:8000/api/list/column")
      .then((response) => {
        this.info = response.data.data;
      })
      .catch((error) => {
        console.log(error);
        this.errored = true;
      });
  },
};
</script>

<style>
.button-primary {
  background: #75a4fa;
}
.main-section {
  padding: 20px 0;
}
.draggable-column {
  border: 1px solid #000000;
  padding: 20px 20px;
}
.column-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 15px;
}
.column-title {
  margin: 0;
  font-size: 20px;
  font-weight: bold;
}
.column-header button {
  background: transparent;
  padding: 0;
  border: none;
  cursor: pointer;
}
button:focus {
  outline: none;
}
.draggable-column--wrap--card {
  padding: 15px 20px;
  border: 1px solid #000;
}
.draggable-column--wrap--card + .draggable-column--wrap--card {
  margin-top: 20px;
}
.draggable-column--wrap--card h4 {
  font-size: 18px;
  text-transform: capitalize;
  font-weight: bold;
  margin: 0;
}
.draggable-column--wrap--card p {
  margin: 0;
  font-size: 14px;
}
.add-card-btn {
  background: green !important;
  width: 32% !important;
}
</style>
