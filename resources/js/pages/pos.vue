<template>
  <div>
    <div class="row">
      <!-- ສ່ວນ​ສະ​ແດງ​ລາຍ​ການ​ຂາຍຂອງ​ສິນ​ຄ້າ -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <input
              type="text"
              class="form-control"
              placeholder="ຄົ້ນ​ຫາ....."
            />
          </div>
        </div>
        <div class="row mt-3" style="overflow: auto; height: 70vh">
          <!-- card 1 -->
          <div
            class="col-md-4 mb-3"
            v-for="list in StoreData.data"
            :key="list.id"
          >
            <div class="card pointer">
              <div v-for="item in ListOrder" :key="item.id">
                <span class="box-num" v-if="list.id == item.id">{{
                  item.amount
                }}</span>
              </div>
              <img
                class="card-img-top img-size"
                :src="'assets/img/' + list.image"
                alt="Card image cap"
                @click="add_product(list.id)"
                v-if="list.image"
              />
              <img
                class="card-img-top img-size"
                :src="'assets/img/add-image6.png'"
                alt="Card image cap"
                @click="add_product(list.id)"
                v-if="!list.image"
              />
              <div class="card-body text-center">
                <h5 class="card-title">{{ list.name }}</h5>
                <p class="card-text">{{ formatPrice(list.price_sell) }} ກີບ</p>

                <!-- <button
                  type="submit"
                  class="btn rounded-pill btn-label-info"
                  style="width: 100%"
                  @click="add_product(list.id)"
                >
                  <i class="menu-icon bx bx-cart-add"></i>
                  ຊ​ື້​ເລີຍ
                </button> -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ສ່ວນ​ສະ​ແດງ​ລາຍ​ການ​ທີ່​ເລືອກ -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="mb-2">
              <label for="customer-name"> ຊື່​ລູກ​ຄ້າ: </label>
              <input
                type="text"
                class="form-control"
                placeholder="ປ້ອນ​ຊື່​ລູກ​ຄ້າ....."
                v-model="cus_name"
              />
            </div>
            <div class="mb-2">
              <label for="customer-tel"> ເບີ​ໂທ: </label>
              <input
                type="text"
                class="form-control"
                placeholder="ປ້ອນ​ເບີ​ໂທ​....."
                v-model="cus_tel"
              />
            </div>
            <div class="d-flex justify-content-between">
              <span> ຈຳ​ນວນ​ເງິນ​ທັງ​ໝົດ: </span>
              <span>{{ formatPrice(total_price) }} ກີບ</span>
            </div>
            <div class="mt-2">
              <button
                type="button"
                class="btn rounded-pill btn-label-info"
                style="width: 100%"
                :disabled="CheckPay"
                @click="Show_modal()"
              >
                ຊຳ​ລະ​ເງິນ
              </button>
            </div>

            <div style="overflow: auto; height: 45vh">
              <table class="table table-bordered mt-3">
                <thead class="text-center table-info">
                  <tr>
                    <th>ສິນ​ຄ້າ</th>
                    <th>ລາ​ຄາ</th>
                    <th>
                      ​ລວມ (<i
                        class="bx bx-x-circle pointer"
                        style="color: #ff0000"
                        @click="Remove_all()"
                      ></i
                      >)
                    </th>
                  </tr>
                </thead>
                <tbody class="table-primary">
                  <tr v-for="li in ListOrder" :key="li.id">
                    <td>{{ li.name }}</td>
                    <td class="text-end">
                      {{ formatPrice(li.price_sell) }} <br />
                      <i
                        class="bx bxs-plus-circle pointer"
                        style="color: #1765ff"
                        @click="add_product(li.id)"
                      ></i>
                      1
                      <i
                        class="bx bxs-minus-circle poniter"
                        style="color: #000"
                        @click="Remove(li.id)"
                      ></i>
                      |
                      <i
                        class="bx bx-x-circle pointer"
                        style="color: #ff0000"
                        @click="Remove_list(li.id)"
                      ></i>
                    </td>
                    <td class="text-end">
                      {{ formatPrice(li.amount * li.price_sell) }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ສ່ວນ​ຂອງ​ໂມດໍ -->
    <div
      class="modal fade"
      id="addNewCCModal"
      tabindex="-1"
      aria-modal="true"
      role="dialog"
    >
      <div
        class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc"
      >
        <div class="modal-content p-3 p-md-5">
          <div class="modal-body">
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
            <div class="text-center mb-4">
              <h3>ຊຳ​ລະ​ສິນ​ຄ້າ</h3>
              <h5 class="d-flex justify-content-between mb-2">
                <span>ລວມຍອດເງິນ:</span
                ><span>{{ formatPrice(total_price) }} ກີບ</span>
              </h5>
              <h5 class="d-flex justify-content-between mb-2">
                <span>ເງິນທີ່ຮັບນຳລູກຄ້າ:</span
                ><span>{{ formatPrice(CashAmont) }} ກີບ</span>
              </h5>
              <h5
                class="d-flex justify-content-between mb-2 text-danger"
                v-if="CashBack > 0"
              >
                <span>ເງິນ​ທອນ:</span
                ><span>{{ formatPrice(CashBack) }} ກີບ</span>
              </h5>
              <cleave
                :options="options"
                type="text"
                class="form-control"
                style="text-align: right"
                v-model="CashAmont"
              />
              <!-- ເລກ number -->
              <div class="p-2 justify-content-center d-flex">
                <div class="row" style="width: 250px">
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum(1)"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                      >1</a
                    >
                  </div>
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum(2)"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                      >2</a
                    >
                  </div>
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum(3)"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                      >3</a
                    >
                  </div>
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum(4)"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                      >4</a
                    >
                  </div>
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum(5)"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                      >5</a
                    >
                  </div>
                  <div class="col-4 text-center mt-2">
                    <button
                      @click="AddNum(6)"
                      type="button"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                    >
                      6
                    </button>
                  </div>
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum(7)"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                      >7</a
                    >
                  </div>
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum(8)"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                      >8</a
                    >
                  </div>
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum(9)"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                      >9</a
                    >
                  </div>
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum('00')"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                      >00</a
                    >
                  </div>
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum(0)"
                      class="btn btn-primary btn-lg text-white"
                      style="width: 60px"
                      >0</a
                    >
                  </div>
                  <div class="col-4 text-center mt-2">
                    <a
                      @click="AddNum('-')"
                      class="btn btn-danger btn-lg text-white"
                      style="width: 60px"
                    >
                      <i class="bx bx-left-arrow-alt"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 text-center mt-3">
              <button
                type="button"
                class="btn rounded-pill btn-label-info me-1 mt-3"
                :disabled="ConPay"
                @click="ConPayment()"
              >
                ຊຳ​ລະ​ເງິນ
              </button>
              <!-- <button
                type="reset"
                class="btn btn-label-secondary btn-reset mt-3"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Cancel
              </button> -->
            </div>
            <input type="hidden" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "MyApp1Pos",

  data() {
    return {
      cus_tel: "",
      cus_name: "",
      CashAmont: "",
      ListOrder: [],
      StoreData: [],
      Search: "",
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
    };
  },

  mounted() {},
  computed: {
    CashBack() {
      return this.CashAmont - this.total_price;
    },
    CheckPay() {
      if (this.total_price > 0) {
        return false;
      } else {
        return true;
      }
    },
    ConPay() {
      if (this.total_price <= this.CashAmont) {
        return false;
      } else {
        return true;
      }
    },
    total_price() {
      return this.ListOrder.reduce(
        (num, item) => num + item.amount * item.price_sell,
        0
      );
    },
  },
  methods: {
    ConPayment() {
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .post(`/api/transection/add`, {
            acc_type: "income",
            listorder: this.ListOrder,
            cus_name: this.cus_name,
            cus_tel: this.cus_tel,
          })
          .then((response) => {
            // ປິດ ບ໋ອກຊຳລະເງິນ
            $("#addNewCCModal").modal("hide");
            // clear ລາຍການສັ່ງຊື້
            this.ListOrder = [];
            // clear ເງິນທີ່ຮັບນຳລູກຄ້າ
            this.CashAmount = "";
            // ອັບເດດລາຍການ ສັ່ງຊື້
            this.getDataStore();

            if (response.data.success) {
              window.open(
                window.location.origin + "/api/bill/" + response.data.Bill_id,
                "_blank"
              );
              this.$swal(
                "ສຳ​ເລັດ",
                response.data.message,
                response.data.message,
                "success"
              );
            }
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },
    AddNum(num) {
      if (num == "-") {
        this.CashAmont = this.CashAmont.slice(0, -1);
      } else {
        this.CashAmont = this.CashAmont + num;
      }
    },
    Show_modal() {
      $("#addNewCCModal").modal("show");
      this.CashAmont = "";
    },
    Remove_all() {
      this.ListOrder = [];
    },
    Remove_list(id) {
      this.ListOrder.splice(this.ListOrder.map((i) => i.id).indexOf(id), 1);
    },
    Remove(id) {
      this.ListOrder.find((i) => i.id == id).amount--;
      let item = this.ListOrder.find((i) => i.id == id).amount;
      if (item <= 0) {
        this.ListOrder.splice(this.ListOrder.map((i) => i.id).indexOf(id), 1);
      }
    },
    add_product(id) {
      let item = this.StoreData.data.find((i) => i.id == id);

      //console.log(item)

      if (item.amount > 0) {
        //console.log('Ok')

        let list_order = this.ListOrder.find((i) => i.id == id);

        if (list_order) {
          // ກວດຊອບວ່າ ລາຍການສັ່ງ ລະຫັດສິນຄ້ານີ້ ມີຢູ່ລາຍການສັ່ງຊື້ຫຼືບໍ່

          let old_order_amount = list_order.amount;

          console.log("ຈຳນວນໃນສະຕ໋ອກ: " + item.amount);

          if (item.amount - old_order_amount > 0) {
            // ກວດຊອບ ລາຍການສິນຄ້າ ກັບ ລາຍການສັ່ງຊື້

            // ກວດຊອບ ເພີ່ມລາຍການສິນຄ້າ
            if (this.ListOrder.find((i) => i.id == id)) {
              this.ListOrder.find((i) => i.id == id).amount++;
            } else {
              this.ListOrder.push({
                id: item.id,
                name: item.name,
                price_sell: item.price_sell,
                amount: 1,
              });
            }
          } else {
            this.$swal.fire("ຂໍ​ອະ​ໄພ!", "ສິນຄ້າໝົດແລ້ວ!", "error");
          }
        } else {
          // ກວດຊອບ ເພີ່ມລາຍການສິນຄ້າ
          if (this.ListOrder.find((i) => i.id == id)) {
            this.ListOrder.find((i) => i.id == id).amount++;
          } else {
            this.ListOrder.push({
              id: item.id,
              name: item.name,
              price_sell: item.price_sell,
              amount: 1,
            });
          }
        }
      } else {
        this.$swal.fire("ຜິດຜາດ!", "ສິນຄ້າໝົດແລ້ວ!", "error");
      }
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

    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(",", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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

<style>
.pointer {
  cursor: pointer;
}
.box-num {
  position: absolute;
  background-color: blue;
  color: white;
  right: 0px;
  padding: 8px;
  border-radius: 0 8px 0 25px;
}
.img-size {
  height: 200px;
  width: 100%;
  object-fit: contain;
  object-position: center;
}
</style>