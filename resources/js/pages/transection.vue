<template>
  <div>
    <div>
    <store-report></store-report>

      <div class="card">
        <h3 class="card-header text-center fw-bold"> ລາຍ​ງານການ​ເຄື່ອນ​ໄຫວ​ທຸ​ລະ​ກຳ</h3>
        <div class="d-flex justify-content-end p-2">
          <div class="btn-group me-2" role="group" aria-label="Basic example">
            <button
              type="button"
              class="btn btn-secondary"
              @click="month_type = 'm'"
            >
              <i class="bx bx-chevron-right" v-if="month_type == 'm'"></i> ເດືອນ
            </button>
            <button
              type="button"
              class="btn btn-info"
              @click="month_type = 'y'"
            >
              <i class="bx bx-chevron-right" v-if="month_type == 'y'"></i> ປີ
            </button>
          </div>
          <input
            type="date"
            class="form-control me-2"
            style="width: 150px"
            v-model="dmy"
          />
          <button
            type="button"
            class="btn rounded-pill btn-success"
            @click="getDataTran()"
          >
            ສະ​ແດງ​ການ​ເຄື່ອນ​ໄຫວ
          </button>
        </div>
        <div class="table-responsive text-nowrap p-1">
          <table class="table table-bordered">
            <thead class="table table-info text-center">
              <tr>
                <th
                  class="text-danger fw-bold"
                  style="width: auto; font-size: 20px"
                >
                  ວັນທີ/ເດືອນ/ປີ
                </th>
                <th
                  class="text-danger fw-bold"
                  style="width: auto; font-size: 20px"
                >
                  ເລກ​ທີ​
                </th>
                <th
                  class="text-danger fw-bold"
                  style="width: auto; font-size: 20px"
                >
                  ປ​ະ​ເພດ​
                </th>
                <th
                  class="text-danger fw-bold"
                  style="width: auto; font-size: 20px"
                >
                  ລາຍ​ລະ​ອຽດ
                </th>
                <th
                  class="text-danger fw-bold"
                  style="width: auto; font-size: 20px"
                >
                  ມູນ​ຄ່າ
                </th>
              </tr>
            </thead>
            <tbody class="table text-center">
              <tr v-for="list in TranData.data" :key="list.id">
                <td>{{ date(list.created_at) }}</td>
                <td>{{ list.tran_id }}</td>
                <td>{{ list.tran_type }}</td>
                <td>{{ list.tran_detail }}</td>
                <td class="text-end">{{ formatPrice(list.price) }}</td>
              </tr>
            </tbody>
          </table>

          <!-- pagination page-->
          <div class="d-flex justify-content-right">
            <pagination
              :pagination="TranData"
              :offset="4"
              @paginate="getDataTran($event)"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  name: "MyApp1Transection",

  data() {
    return {
      TranData: [],
      month_type: "y",
      dmy: "",
    };
  },
  components: {
    moment,
  },

  mounted() {},

  methods: {
    date(value) {
      return moment(value).format("DD/MM/YYYY");
    },

    getDataTran(page) {
      this.$axios.get("/sanctum/csrf-cookie").then((response) => {
        this.$axios
          .post(`api/transection?page=${page}`, {
            month_type: this.month_type,
            dmy: this.dmy,
          })
          .then((response) => {
            this.TranData = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
      });
    },

    // ເພີ່ມ​ຈຸດໃນ​ຕາ​ຕະ​ລາງ
    formatPrice(value) {
      let val = (value / 1).toFixed(0).replace(",", ".");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
  },

  created() {
    this.getDataTran();
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