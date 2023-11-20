<template>
  <div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-6 mb-4">
        <div class="card">
          <div class="card-body pb-0">
            <span class="d-block fw-medium fw-bold"> ລາຍ​ຮັບ</span>
          </div>

          <div class="p-3 pt-2 d-flex justify-content-between">
            <i class="bx bx-line-chart"></i>
            <span> 0 ກີບ</span>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 205px; height: 180px"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-6 mb-4">
        <div class="card">
          <div class="card-body pb-0">
            <span class="d-block fw-medium fw-bold"> ລາຍ​ຈ່າຍ</span>
          </div>

          <div class="p-3 pt-2 d-flex justify-content-between">
            <i class="bx bx-line-chart"></i>
            <span> 0 ກີບ</span>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 205px; height: 180px"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-6 mb-4">
        <div class="card">
          <div class="card-body pb-0">
            <span class="d-block fw-medium fw-bold"> ກ​ຳ​ໄລ</span>
          </div>

          <div class="p-3 pt-2 d-flex justify-content-between">
            <i class="bx bx-line-chart"></i>
            <span> 0 ກີບ</span>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 205px; height: 180px"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-6 mb-4">
        <div class="card">
          <div class="card-body pb-0">
            <span class="d-block fw-medium fw-bold"> ສະ​ຕ໋ອກ​ສິນ​ຄ້າ</span>
          </div>

          <div class="p-3 pt-2 d-flex justify-content-between">
            <i class="bx bx-line-chart"></i>
            <span> 0 ກີບ</span>
          </div>
          <div class="resize-triggers">
            <div class="expand-trigger">
              <div style="width: 205px; height: 180px"></div>
            </div>
            <div class="contract-trigger"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- tables -->
    <div class="card">
      <div v-if="!FormShow">
        <h1 class="card-header text-center fw-bold">Product list</h1>
      </div>
      <!--       
      <hr />
      {{ FormStore }} | {{ FormType }}
      <hr />
      {{ StoreData }}
      <hr /> -->

      <div class="d-flex justify-content-end">
        <button
          type="button"
          class="btn rounded-pill btn-info me-3 mb-3"
          v-if="!FormShow"
          @click="show()"
        >
          <i class="menu-icon bx bx-cart-add"></i> ເພີ່ມ
        </button>
      </div>

      <!-- form image -->
      <div class="row p-3" v-if="FormShow">
        <div class="col-md-4">
          <img :src="image_preview" alt="" style="width: 100%" />
          <input type="file" class="form-control mt-2" @change="onSelection" />
        </div>

        <!-- Form -->
        <div class="col-md-8">
          <div class="mb-3">
            <div>
              <label
                for="defaultFormControlInput"
                class="form-label fw-bold"
                style="font-size: 20px"
              >
                ສິນ​ຄ້າ</label
              >
              <input
                type="text"
                class="form-control"
                id="defaultFormControlInput"
                placeholder="ກະ​ລຸ​ນາ​ປ້ອນ​ຊື່​ສິນ​ຄ້າ"
                aria-describedby="defaultFormControlHelp"
                v-model="FormStore.name"
              />
            </div>
          </div>
          <div class="mb-3">
            <div>
              <label
                for="defaultFormControlInput"
                class="form-label fw-bold"
                style="font-size: 20px"
              >
                ຈຳ​ນວນ</label
              >
              <input
                type="number"
                class="form-control"
                id="defaultFormControlInput"
                placeholder="ຈຳ​ນວນ"
                aria-describedby="defaultFormControlHelp"
                v-model="FormStore.amount"
              />
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div>
                <label
                  for="defaultFormControlInput"
                  class="form-label fw-bold"
                  style="font-size: 18px"
                >
                  ລາ​ຄາ​ຊື້</label
                >
                <cleave
                  :options="options"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="ລາ​ຄາ​ຊື້"
                  aria-describedby="defaultFormControlHelp"
                  v-model="FormStore.price_buy"
                />
              </div>
            </div>
            <div class="col-md-6">
              <div>
                <label
                  for="defaultFormControlInput"
                  class="form-label fw-bold"
                  style="font-size: 18px"
                >
                  ລາ​ຄາ​ຂາຍ</label
                >
                <cleave
                  :options="options"
                  class="form-control"
                  id="defaultFormControlInput"
                  placeholder="ລາ​ຄາ​ຂາຍ"
                  aria-describedby="defaultFormControlHelp"
                  v-model="FormStore.price_sell"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ຕາ​ຕະ​ລາງ​ສະ​ແດງ​ຂໍ້​ມູນ -->
      <div v-if="!FormShow">
        <div class="d-flex justify-content-end mb-2 me-2">
          <!-- ສ່ວນ​ຂອງ​ການ​ຄົ້ນ​ຫາ -->
          <input
            type="text"
            class="form-control"
            id="defaultFormControlInput"
            placeholder="ຄົ້ນ​ຫາ"
            aria-describedby="defaultFormControlHelp"
            style="width: 300px"
            v-model="Search"
            @keyup="getDataStore()"
          />
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr class="table-dark text-center">
                <th class="text-white" style="width: auto; font-size: 20px">
                  ລະ​ຫັດ​ສິນ​ຄ້າ
                </th>
                <th class="text-white" style="font-size: 20px">ຊື່​ສິນ​ຄ້າ</th>
                <th class="text-white" style="font-size: 20px">
                  ຈຳ​ນວນ​ສິນ​ຄ້າ
                </th>
                <th class="text-white" style="font-size: 20px">ລາ​ຄາ​ຊື້</th>
                <th class="text-white" style="font-size: 20px">ລາ​ຄາ​ຂາຍ</th>
                <th class="text-white" style="width: auto; font-size: 20px">
                  ຈັດ​ການ
                </th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0 text-center">
              <tr v-for="list in StoreData.data" :key="list.id">
                <td>{{ list.id }}</td>
                <td>{{ list.name }}</td>
                <td>{{ list.amount }}</td>
                <td>{{ formatPrice(list.price_buy) }}</td>
                <td>{{ formatPrice(list.price_sell) }}</td>

                <td>
                  <div class="dropdown">
                    <button
                      type="button"
                      class="btn p-0 dropdown-toggle hide-arrow"
                      data-bs-toggle="dropdown"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a
                        class="dropdown-item"
                        href="javascript:void(0);"
                        @click="Edit(list.id)"
                        ><i class="bx bx-edit-alt me-1"></i> ແກ້​ໄຂ</a
                      >
                      <a
                        class="dropdown-item"
                        href="javascript:void(0);"
                        @click="Delete(list.id)"
                        ><i class="bx bx-trash me-1"></i> ລຶບ</a
                      >
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- pagination page-->
        <div class="d-flex justify-content- me-2">
          <pagination
            :pagination="StoreData"
            :offset="4"
            @paginate="getDataStore($event)"
          />
        </div>
      </div>

      <!-- ປຸ່ມ​ກົດ -->
      <div class="d-flex justify-content-end">
        <button
          type="button"
          class="btn rounded-pill btn-primary me-3 mb-3 mt-3"
          v-if="FormShow"
          @click="save_Data()"
        >
          <i class="menu-icon bx bx-save"></i> ບັນ​ທຶກ
        </button>
        <button
          type="button"
          class="btn rounded-pill btn-danger me-3 mb-3 mt-3"
          v-if="FormShow"
          @click="close()"
        >
          <i class="menu-icon bx bx-window-close"></i> ຍົກ​ເລີກ
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MyApp1Store",

  data() {
    return {
      image_preview: window.location.origin + "/assets/img/upload.jpg",
      Search: "",
      image_product: "",
      options: {
        //prefix: '₭ ', ເພີ່ມ​ຈຸດຫຼັກ​ພັນ ບ່ອນ​ປ້ອນ​ຂໍ້​ມູນ
        numeral: true,
        numeralPositiveOnly: true,
        noImmediatePrefix: true,
        rawValueTrimPrefix: true,
        numeralIntegerScale: 10,
        numeralDecimalScale: 2,
        numeralDecimalMark: ",",
        delimiter: ".",
      },

      EditID: "",
      FormType: false,
      FormShow: false,
      StoreData: [],
      FormStore: {
        name: "",
        amount: "",
        price_buy: "",
        price_sell: "",
      },
    };
  },

  mounted() {},

  methods: {
    onSelection(event){
      this.image_product = event.target.files[0];
      let reader = new FileReader();
      reader.readAsDataURL(this.image_product);
      reader.addEventListener(
        "load",
        function () {
          this.image_preview = reader.result;
        }.bind(this),
        false
      );
    },
    // ສະ​ແດງ​ຟອມກອກ​ຂໍ້​ມູນ
    show() {
      this.FormShow = true;
    },

    // ເພີ່ມ​ຈຸດໃນ​ຕາ​ຕະ​ລາງ
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(",", ".");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },

    // ເຊື່ອງ​ຟອມກອກ​ຂໍ້​ມູນ
    close() {
      this.FormShow = false;
      this.FormStore.name = "";
      this.FormStore.amount = "";
      this.FormStore.price_buy = "";
      this.FormStore.price_sell = "";
      this.image_preview = window.location.origin + "/assets/img/upload.jpg";
    },

    // save
    save_Data() {
      if (this.FormType) {
        let FormDataStore = new FormData();
        FormDataStore.append("name", this.FormStore.name);
        FormDataStore.append("amount", this.FormStore.amount);
        FormDataStore.append("price_buy", this.FormStore.price_buy);
        FormDataStore.append("price_sell", this.FormStore.price_sell);
        FormDataStore.append("image", this.image_product);
        // // if FormType ມີ​ຄ່າ​ເປັນ​ຈິງ​ແລ້ວ​ໃຫ້​ມັນ​ອັບ​ເດດ
        // this.StoreData.find((i) => i.id == this.EditID).name =
        //   this.FormStore.name;
        // this.StoreData.find((i) => i.id == this.EditID).amount =
        //   this.FormStore.amount;
        // this.StoreData.find((i) => i.id == this.EditID).price_buy =
        //   this.FormStore.price_buy;
        // this.StoreData.find((i) => i.id == this.EditID).price_sell =
        //   this.FormStore.price_sell;

        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
          this.$axios
            .post(`/api/store/update/${this.EditID}`, FormDataStore, {headers: { "content-type": "multipart/form-data" }, })
            .then((response) => {
              console.log("ສ​ຳ​ເລັດ");

              if (response.data.success) {
                this.$swal({
                  position: "center",
                  icon: "success",
                  title: response.data.message,
                  showConfirmButton: false,
                  timer: 1500,
                });
                this.getDataStore();
              }
            })
            .catch((error) => {
              console.log(error);
            });
        });
      } else {
        // if Formtype ມີ​ຄ່າ​ເປັນ​ບໍ່​ຈິງ​ແລ້ວ ໃຫ້​ມັນ​ເພີ່ມ​ຂໍ້​ມູນ​ເຂົ້າ​ໃໝ່
        // this.StoreData.push({
        //   id: Math.floor(Math.random() * 1000),
        // name: this.FormStore.name,
        // amount: this.FormStore.amount,
        // price_buy: this.FormStore.price_buy,
        // price_sell: this.FormStore.price_sell,
        // });
        let FormDataStore = new FormData();
        FormDataStore.append("name", this.FormStore.name);
        FormDataStore.append("amount", this.FormStore.amount);
        FormDataStore.append("price_buy", this.FormStore.price_buy);
        FormDataStore.append("price_sell", this.FormStore.price_sell);
        FormDataStore.append("image", this.image_product);
        this.$axios.get("/sanctum/csrf-cookie").then((response) => {
          this.$axios
            .post("/api/store/add", FormDataStore, {headers: { "content-type": "multipart/form-data" }, })
            .then((response) => {
              console.log("ສ​ຳ​ເລັດ");

              if (response.data.success) {
                this.$swal({
                  position: "center",
                  icon: "success",
                  title: response.data.message,
                  showConfirmButton: false,
                  timer: 1500,
                });
                this.getDataStore();
              }
            })
            .catch((error) => {
              console.log(error);
            });
        });
      }

      // ເຄຍ​ຟອມ​ຂໍ້​ມູນ
      (this.FormStore.name = ""),
        (this.FormStore.amount = ""),
        (this.FormStore.price_buy = ""),
        (this.FormStore.price_sell = "");

      this.image_preview = window.location.origin + "/assets/img/upload.jpg";

      // ຍົກ​ເລີກ​ຟອມ
      this.FormShow = false;

      // ກຳ​ນົດ​ສະ​ຖາ​ນະ​ຟອມ
      this.FormType = false;
    },

    // ແກ້​ໄຂ​ຂໍ້​ມູນ​ຂໍ້​ມູນ​ໃນ​ຕາ​ຕະ​ລາງ
    Edit(id) {
      this.EditID = id;

      // ທຳ​ການ​ຄົ້ນ​ຫາ​ໄອ​ດີ ແລ້ວ​ໄປ​ເກັບ​ໄວ້​ໃນ​ຕົວ​ປ່ຽນ
      // let item = this.StoreData.find((i) => i.id == id);

      // ນຳ​ຂ​ໍ້​ມູນ​ທີ່​ໄດ້​ ໄປ​ເກັບ​ໃນ​ຟອມ
      // this.FormStore.name = item.name;
      // this.FormStore.amount = item.amount;
      // this.FormStore.price_buy = item.price_buy;
      // this.FormStore.price_sell = item.price_sell;
      this.$axios.get("sanctum/csrf-cookie").then((response) => {
        this.$axios
          .get(`/api/store/edit/${id}`)
          .then((response) => {
            this.FormStore.name = response.data.name;
            this.FormStore.amount = response.data.amount;
            this.FormStore.price_buy = response.data.price_buy;
            this.FormStore.price_sell = response.data.price_sell;
          })
          .catch((error) => {
            console.log(error);
          });

        // ໂຊ​ຟອມ
        this.FormShow = true;

        // ກຳ​ນົດ​ສະ​ຖາ​ນະ​ຟອມ
        this.FormType = true;
      });
    },

    // ລົບ​ຂໍ້​ມູນ​ໃນ​ຕາ​ຕະ​ລາງ
    Delete(id) {
      // let index = this.StoreData.map((i) => i.id).indexOf(id);
      // this.StoreData.splice(index, 1);
      this.$swal({
        title: "ທ່ານ​ແນ່​ໃຈ ຫຼື ບໍ່?",
        text: "​ທີ່​ຈະ​ລົບ​ລາຍ​ການ​ນີ້!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ຕົກ​ລົງ",
        cancelButtonText: "ຍົກ​ເລີກ",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$axios.get("sanctum/csrf-cookie").then((response) => {
            this.$axios
              .delete(`/api/store/delete/${id}`)
              .then((response) => {
                if (response.data.success) {
                  this.$swal({
                    position: "center",
                    icon: "success",
                    title: response.data.message,
                    showConfirmButton: false,
                    timer: 1500,
                  });
                  this.getDataStore();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          });
        }
      });
    },

    getDataStore(page) {
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .get(`/api/store?page=${page}&search=${this.Search}`)
          .then((response) => {
            this.StoreData = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
  },

  created() {
    this.getDataStore();
  },

  beforeRouteEnter(to, from, next) {
    if (window.Laravel.isLogin) {
      next();
    } else {
      window.location.href = "/login";
    }
  },
};
</script>

<style lang="scss" scoped>
</style>